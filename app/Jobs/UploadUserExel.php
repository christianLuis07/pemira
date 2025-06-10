<?php

namespace App\Jobs;

use Throwable;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjar;
use App\Models\DetailUser;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UploadUserExel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $fileExelUpload;

    public function __construct($fileExelUpload)
    {
        $this->fileExelUpload = $fileExelUpload;
    }

    /**
     * Execute the job.
     */
    public function handle() :void
    {
        try {
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($this->fileExelUpload);

            $row = 2;

            foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $dataRow) {
                $username = $spreadsheet->getActiveSheet()->getCell('A' . $row)->getValue();
                $email = $spreadsheet->getActiveSheet()->getCell('B' . $row)->getValue();
                $nama = $spreadsheet->getActiveSheet()->getCell('C' . $row)->getValue();
                $kelas = $spreadsheet->getActiveSheet()->getCell('D' . $row)->getValue();
                $prodi = $spreadsheet->getActiveSheet()->getCell('E' . $row)->getValue();
                $tahun = $spreadsheet->getActiveSheet()->getCell('F' . $row)->getValue();

                $password = Str::random(8);

                // sleep(1);
                $saveDataUser = SaveDataUser::dispatch($username, $email, $nama, $kelas, $prodi, $tahun, $password)->onQueue('saveDataUser');

                $row++;
            }

            $process = true;

        } catch (Throwable $e) {

            logger()->error($e->getMessage());

        }
    }
}
