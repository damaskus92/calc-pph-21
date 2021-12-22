<?php

namespace App\Http\Livewire\Tax\Pph21;

use Livewire\Component;

class Pph21Index extends Component
{
    public $input;
    public $result;

    public $calculator = [
        'ptkp_value'           => 0,
        'basic_salary'         => 0,
        'allowance'            => 0,
        'bonus'                => 0,
        'pph_allowance'        => 0,
        'total_gross'          => 0,
        'pension_contribution' => 0,
        'position_cost'        => 0,
        'total_net'            => 0,
        'total_net_year'       => 0,
        'ptkp_year'            => 0,
        'pkp_year'             => 0,
        'tax_payable_year'     => 0,
        'tax_payable_month'    => 0,
        'tax_discount'         => 0,
        'total_tax_month'      => 0,
    ];

    public $isVisible = true;

    public function mount()
    {
        $this->fill([
            'input' => [
                'ptkp_status' => '',
                'ptkp_value' => 0,
                'basic_salary' => 0,
                'allowance' => 0,
                'bonus' => 0,
                'pph_allowance' => 0,
                'total_gross' => 0,
                'pension_contribution' => 0,
                'position_cost' => 0,
                'total_net' => 0,
            ],
            'result' => [
                'total_net_year' => 0,
                'ptkp_year' => 0,
                'pkp_year' => 0,
                'tax_payable_year' => 0,
                'tax_payable_month' => 0,
                'tax_discount' => 0,
                'total_tax_month' => 0,
            ],
        ]);
    }

    protected $listeners = ['$refresh'];

    public function render()
    {
        $data = $this->hanldeCalculator();

        $this->input['ptkp_value']           = number_format($data['ptkp_value'], 0, '', '.');
        $this->input['basic_salary']         = number_format($data['basic_salary'], 0, '', '.');
        $this->input['allowance']            = number_format($data['allowance'], 0, '', '.');
        $this->input['bonus']                = number_format($data['bonus'], 0, '', '.');
        $this->input['pph_allowance']        = number_format($data['pph_allowance'], 0, '', '.');
        $this->input['total_gross']          = number_format($data['total_gross'], 0, '', '.');
        $this->input['pension_contribution'] = number_format($data['pension_contribution'], 0, '', '.');
        $this->input['position_cost']        = number_format($data['position_cost'], 0, '', '.');
        $this->input['total_net']            = number_format($data['total_net'], 0, '', '.');

        $this->result['total_net_year'] = number_format($data['total_net_year'], 0, '', '.');
        $this->result['ptkp_year'] = number_format($data['ptkp_year'], 0, '', '.');
        $this->result['pkp_year'] = number_format($data['pkp_year'], 0, '', '.');
        $this->result['tax_payable_year'] = number_format($data['tax_payable_year'], 0, '', '.');
        $this->result['tax_payable_month'] = number_format($data['tax_payable_month'], 0, '', '.');
        $this->result['tax_discount'] = number_format($data['tax_discount'], 0, '', '.');
        $this->result['total_tax_month'] = number_format($data['total_tax_month'], 0, '', '.');

        return view('livewire.tax.pph21.pph21-index');
    }

    public function updated($field, $value)
    {
        $parts = explode('.', $field);

        if (count($parts) === 2) {
            if ($parts[1] === 'ptkp_status') {
                $ptkp_add = 4500000;

                $tk_0 = 54000000;
                $k_0  = $tk_0 + $ptkp_add;
                $k_1  = $k_0 + $ptkp_add;
                $k_2  = $k_1 + $ptkp_add;
                $k_3  = $k_2 + $ptkp_add;

                switch ($value) {
                    case 'tk_0':
                        $this->input['ptkp_value'] = number_format($tk_0, 0, '', '.');
                        break;

                    case 'k_0':
                        $this->input['ptkp_value'] = number_format($k_0, 0, '', '.');
                        break;

                    case 'k_1':
                        $this->input['ptkp_value'] = number_format($k_1, 0, '', '.');
                        break;

                    case 'k_2':
                        $this->input['ptkp_value'] = number_format($k_2, 0, '', '.');
                        break;

                    case 'k_3':
                        $this->input['ptkp_value'] = number_format($k_3, 0, '', '.');
                        break;

                    default:
                        $this->input['ptkp_value'] = 0;
                        break;
                }

                $this->calculator['ptkp_value'] = (int) str_replace('.', '', $this->input['ptkp_value']);
                $this->calculator['ptkp_year'] = (int) str_replace('.', '', $this->input['ptkp_value']);
            }

            switch ($parts[1]) {
                case 'basic_salary':
                    $this->calculator['basic_salary'] = (int) str_replace('.', '', $value);
                    break;

                case 'allowance':
                    $this->calculator['allowance'] = (int) str_replace('.', '', $value);
                    break;

                case 'bonus':
                    $this->calculator['bonus'] = (int) str_replace('.', '', $value);
                    break;

                case 'pph_allowance':
                    $this->calculator['pph_allowance'] = (int) str_replace('.', '', $value);
                    break;

                case 'pension_contribution':
                    $this->calculator['pension_contribution'] = (int) str_replace('.', '', $value);
                    break;
            }
        }
    }

    public function hanldeCalculator()
    {
        $basic_salary         = $this->calculator['basic_salary'];
        $allowance            = $this->calculator['allowance'];
        $bonus                = $this->calculator['bonus'];
        $pph_allowance        = $this->calculator['pph_allowance'];
        $pension_contribution = $this->calculator['pension_contribution'];
        $ptkp                 = $this->calculator['ptkp_value'];

        $calc_total_gross    = $basic_salary + $allowance + $bonus + $pph_allowance;
        $calc_position_cost  = intval($calc_total_gross * 0.05) > 500000 ? 500000 : $calc_total_gross * 0.05;
        $calc_total_net      = $calc_total_gross - ($calc_position_cost + $pension_contribution);
        $calc_total_net_year = $calc_total_net * 12;

        if ($calc_total_net_year > $ptkp) {
            $calc_pkp = $calc_total_net_year - $ptkp;
        } else {
            $calc_pkp = 0;
        }

        if ($calc_pkp < 50000000) {
            $calc_tax_payable_year = $calc_pkp * 0.05;
        } elseif ($calc_pkp > 50000000 && $calc_pkp < 250000000) {
            $calc_tax_payable_year = $calc_pkp * 0.15;
        } elseif ($calc_pkp > 250000000 && $calc_pkp < 500000000) {
            $calc_tax_payable_year = $calc_pkp * 0.25;
        } elseif ($calc_pkp > 500000000) {
            $calc_tax_payable_year = $calc_pkp * 0.3;
        }

        $calc_tax_payable_month = $calc_tax_payable_year / 12;
        $calc_tax_discount = 0;
        $calc_total_tax_month = $calc_tax_payable_month - $calc_tax_discount;

        $this->calculator['total_gross']       = intval($calc_total_gross);
        $this->calculator['position_cost']     = intval($calc_position_cost);
        $this->calculator['total_net']         = intval($calc_total_net);
        $this->calculator['total_net_year']    = intval($calc_total_net_year);
        $this->calculator['ptkp_year']         = intval($ptkp);
        $this->calculator['pkp_year']          = intval($calc_pkp);
        $this->calculator['tax_payable_year']  = intval($calc_tax_payable_year);
        $this->calculator['tax_payable_month'] = intval($calc_tax_payable_month);
        $this->calculator['tax_discount']      = intval($calc_tax_discount);
        $this->calculator['total_tax_month']   = intval($calc_total_tax_month);

        return $this->calculator;
    }

    public function submit()
    {
        $this->isVisible = true;
    }

    public function clear()
    {
        return redirect()->route('pph-21.index');
    }
}
