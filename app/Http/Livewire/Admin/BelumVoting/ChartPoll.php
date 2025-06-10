<?php

namespace App\Http\Livewire\Admin\BelumVoting;

use App\Models\Organisasi;
use App\Models\User;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class ChartPoll extends Component
{
    public $organisasi;
    public $tabOrganisasi;
    public $colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8'];


    public function mount()
    {
        $this->organisasi = Organisasi::has("kandidat")->where("active", true)
            ->select("id", "name")
            ->get();

        if (isset($this->organisasi->first()->id)) {
            $this->tabOrganisasi = $this->organisasi->first()->id;
        } else {
            $this->tabOrganisasi = null;
        }
    }

    public function counter()
    {
        $this->render();
    }

    public function select($id)
    {
        $this->tabOrganisasi = $id;
        $this->render();
    }

    public function render()
    {
        if ($this->tabOrganisasi != null) {
            // Ambil data organisasi yang dipilih
            $dataOrganisasi = Organisasi::where('id', $this->tabOrganisasi)->first();

            // Hitung jumlah user yang belum voting untuk organisasi ini
            // User belum voting jika dia tidak memiliki perolehan suara untuk kandidat manapun di organisasi ini
            $belumVotingOrganisasi = User::whereDoesntHave('perolehanSuara', function ($query) use ($dataOrganisasi) {
                $query->whereHas('kandidat', function ($subQuery) use ($dataOrganisasi) {
                    $subQuery->where('organisasi_id', $dataOrganisasi->id);
                });
            })
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'admin');
                })
                ->count();

            // Buat chart dengan satu kolom untuk organisasi
            $columnChartModel = LivewireCharts::columnChartModel()
                ->setTitle('Belum Voting - ' . $dataOrganisasi->name)
                ->setAnimated(true)
                ->setOpacity(1)
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setLegendVisibility(true)
                ->setDataLabelsEnabled(true)
                ->setColors($this->colors)
                ->addColumn($dataOrganisasi->name, $belumVotingOrganisasi, $this->colors);

            $organisasiName = $dataOrganisasi->name;
        } else {
            $columnChartModel = null;
            $organisasiName = null;
        }

        return view('livewire.admin.belum-voting.chart-poll', [
            'columnChartModel' => $columnChartModel,
            'organisasiName' => $organisasiName
        ]);
    }
}
