<?php

namespace App\Http\Livewire\Tax\Pph21;

use Livewire\Component;

class Pph21Index extends Component
{
    public $input;
    public $autofill;

    public $result = [
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
        'tax_on_bonus'         => 0,
        'total_tax_month'      => 0,
    ];

    public $isVisible = true;

    public function mount()
    {
        $this->fill([
            'input' => [
                'ptkp_status' => '',
                'basic_salary' => 0,
                'allowance' => 0,
                'bonus' => 0,
                'pph_allowance' => 0,
                'pension_contribution' => 0,
            ],
            'autofill' => [
                'ptkp_value' => 0,
                'total_gross' => 0,
                'position_cost' => 0,
                'total_net' => 0,
                'total_net_year' => 0,
                'ptkp_year' => 0,
                'pkp_year' => 0,
                'tax_payable_year' => 0,
                'tax_payable_month' => 0,
                'tax_on_bonus' => 0,
                'total_tax_month' => 0,
            ],
        ]);
    }

    protected $listeners = ['$refresh'];

    public function render()
    {
        $data = $this->taxResult();

        $this->input['basic_salary']         = number_format($data['basic_salary'], 0, '', '.');
        $this->input['allowance']            = number_format($data['allowance'], 0, '', '.');
        $this->input['bonus']                = number_format($data['bonus'], 0, '', '.');
        $this->input['pph_allowance']        = number_format($data['pph_allowance'], 0, '', '.');
        $this->input['pension_contribution'] = number_format($data['pension_contribution'], 0, '', '.');

        $this->autofill['ptkp_value']        = number_format($data['ptkp_value'], 0, '', '.');
        $this->autofill['total_gross']       = number_format($data['total_gross'], 0, '', '.');
        $this->autofill['position_cost']     = number_format($data['position_cost'], 0, '', '.');
        $this->autofill['total_net']         = number_format($data['total_net'], 0, '', '.');
        $this->autofill['total_net_year']    = number_format($data['total_net_year'], 0, '', '.');
        $this->autofill['ptkp_year']         = number_format($data['ptkp_year'], 0, '', '.');
        $this->autofill['pkp_year']          = number_format($data['pkp_year'], 0, '', '.');
        $this->autofill['tax_payable_year']  = number_format($data['tax_payable_year'], 0, '', '.');
        $this->autofill['tax_payable_month'] = number_format($data['tax_payable_month'], 0, '', '.');
        $this->autofill['tax_on_bonus']      = number_format($data['tax_on_bonus'], 0, '', '.');
        $this->autofill['total_tax_month']   = number_format($data['total_tax_month'], 0, '', '.');

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

                $this->result['ptkp_value'] = (int) str_replace('.', '', $this->input['ptkp_value']);
                $this->result['ptkp_year'] = (int) str_replace('.', '', $this->input['ptkp_value']);
            }

            switch ($parts[1]) {
                case 'basic_salary':
                    $this->result['basic_salary'] = (int) str_replace('.', '', $value);
                    break;

                case 'allowance':
                    $this->result['allowance'] = (int) str_replace('.', '', $value);
                    break;

                case 'bonus':
                    $this->result['bonus'] = (int) str_replace('.', '', $value);
                    break;

                case 'pph_allowance':
                    $this->result['pph_allowance'] = (int) str_replace('.', '', $value);
                    break;

                case 'pension_contribution':
                    $this->result['pension_contribution'] = (int) str_replace('.', '', $value);
                    break;
            }
        }
    }

    public function taxResult()
    {
        $basic_salary         = $this->result['basic_salary'];
        $allowance            = $this->result['allowance'];
        $pph_allowance        = $this->result['pph_allowance'];
        $pension_contribution = $this->result['pension_contribution'];
        $ptkp                 = $this->result['ptkp_value'];
        $tax_on_bonus         = $this->taxOnBonus();

        $calc_total_gross    = $basic_salary + $allowance + $pph_allowance;
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

        $calc_tax_on_bonus = 0;

        if ($tax_on_bonus > 0) {
            $calc_tax_on_bonus = $tax_on_bonus - $calc_tax_payable_year;
        }

        $calc_tax_payable_month = $calc_tax_payable_year / 12;
        $calc_total_tax_month   = $calc_tax_payable_month + $calc_tax_on_bonus;

        $this->result['total_gross']       = intval($calc_total_gross);
        $this->result['position_cost']     = intval($calc_position_cost);
        $this->result['total_net']         = intval($calc_total_net);
        $this->result['total_net_year']    = intval($calc_total_net_year);
        $this->result['ptkp_year']         = intval($ptkp);
        $this->result['pkp_year']          = intval($calc_pkp);
        $this->result['tax_payable_year']  = intval($calc_tax_payable_year);
        $this->result['tax_payable_month'] = intval($calc_tax_payable_month);
        $this->result['tax_on_bonus']      = intval($calc_tax_on_bonus);
        $this->result['total_tax_month']   = intval($calc_total_tax_month);

        return $this->result;
    }

    public function taxOnBonus()
    {
        $basic_salary         = $this->result['basic_salary'] * 12;
        $allowance            = $this->result['allowance'] * 12;
        $pph_allowance        = $this->result['pph_allowance'] * 12;
        $pension_contribution = $this->result['pension_contribution'] * 12;
        $bonus                = $this->result['bonus'];
        $ptkp                 = $this->result['ptkp_value'];

        $result = 0;

        if ($this->result['bonus'] > 0) {
            $calc_total_gross   = $basic_salary + $allowance + $pph_allowance + $bonus;
            $calc_position_cost = intval($calc_total_gross * 0.05) > 6000000 ? 6000000 : $calc_total_gross * 0.05;
            $calc_total_net     = $calc_total_gross - ($calc_position_cost + $pension_contribution);

            if ($calc_total_net > $ptkp) {
                $calc_pkp = $calc_total_net - $ptkp;
            } else {
                $calc_pkp = 0;
            }

            if ($calc_pkp < 50000000) {
                $result = $calc_pkp * 0.05;
            } elseif ($calc_pkp > 50000000 && $calc_pkp < 250000000) {
                $result = $calc_pkp * 0.15;
            } elseif ($calc_pkp > 250000000 && $calc_pkp < 500000000) {
                $result = $calc_pkp * 0.25;
            } elseif ($calc_pkp > 500000000) {
                $result = $calc_pkp * 0.3;
            }
        }

        return intval($result);
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
