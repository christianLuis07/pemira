<?php

namespace App\Http\Livewire\Admin\HasilVoting;

use Livewire\Component;
use App\Models\Organisasi;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class ChartPoll extends Component
{
    // public $columnChartModel;
    public $organisasi;
    public $colors = ['#2BA0FD', '#8D77D9', '#FF647A', '#FCBB40', '#2BE7A5'];
    public $tabs;
    public $tabOrganisasi;

    public function mount()
    {
        $this->organisasi = Organisasi::has('kandidat')
        ->where('active', true)
        // ->where('start', '<=', now())
        // ->where('end', '>=', now())
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
        if ($this->tabOrganisasi != null ) {
            $dataOrganisasi = Organisasi::where('id', $this->tabOrganisasi)->has('kandidat')
            ->with(['kandidat' => function ($query) {
                $query->withCount('perolehanSuara');
            }])->withCount('perolehanSuara as perolehanSuaraTotal')->first();

            $columnChartModel = $dataOrganisasi->kandidat->groupBy('id')
                ->reduce(function ($columnChartModel, $data) {
                    // dd($data->first()->perolehan_suara_count);
                    $type = $data->first()->ketua .' & '. $data->first()->wakil;
                    $value = $data->first()->perolehan_suara_count;

                    return $columnChartModel->addColumn($type, $value, $this->colors);
                }, LivewireCharts::columnChartModel()
                    ->setTitle('Perolehan Suara '.$dataOrganisasi->name)
                    ->setAnimated(false)
                    // ->setType('donut')
                    // ->withOnSliceClickEvent('onSliceClick')
                    // ->withoutLegend()
                    ->setOpacity(1)
                    ->legendPositionBottom()
                    ->legendHorizontallyAlignedCenter()
                    ->setLegendVisibility(true)
                    ->setDataLabelsEnabled(true)
                    ->setColors($this->colors)
                );

            $organisasiName = $dataOrganisasi->name;
        }else{
            $columnChartModel = null;
            $organisasiName = null;
        }

        return view('livewire.admin.hasil-voting.chart-poll', [
            'columnChartModel' => $columnChartModel,
            'organisasiName' => $organisasiName
        ]);
    }
}
