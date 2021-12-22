<div>
    <div class="content-header">
        <h2 class="fw-bold">{{ __('Perhitungan PPh 21') }}</h2>
    </div>
    <div class="content-body">
        <div class="row gy-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header fw-bold">{{ __('PTKP') }}</div>
                    <div class="card-body d-grid gap-2 gap-sm-3">
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Status Perkawinan/Tanggungan') }}</label>
                            <div class="col-sm-6">
                                <select wire:model.lazy="input.ptkp_status" class="form-select">
                                    <option value="" selected disabled hidden>Pilih</option>
                                    <option value="tk_0">TK/0</option>
                                    <option value="k_0">K/0</option>
                                    <option value="k_1">K/1</option>
                                    <option value="k_2">K/2</option>
                                    <option value="k_3">K/3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Penghasilan Tidak Kena Pajak') }}</label>
                            <div class="col-sm-6">
                                <input wire:model.lazy="input.ptkp_value" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row gy-3">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header fw-bold">{{ __('Penghasilan') }}</div>
                            <div class="card-body d-grid gap-2 gap-sm-3">
                                <div class="row align-items-center">
                                    <label class="col-sm-6 col-form-label">{{ __('Gaji Pokok') }}</label>
                                    <div class="col-sm-6">
                                        <input wire:model.lazy="input.basic_salary" class="form-control text-end" format-currency="IDR" onClick="this.select();" />
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <label class="col-sm-6 col-form-label">{{ __('Tunjangan Tetap Lainnya') }}</label>
                                    <div class="col-sm-6">
                                        <input wire:model.lazy="input.allowance" class="form-control text-end" format-currency="IDR" onClick="this.select();" />
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <label class="col-sm-6 col-form-label">{{ __('Tantiem, Bonus dan THR') }}</label>
                                    <div class="col-sm-6">
                                        <input wire:model.lazy="input.bonus" class="form-control text-end" format-currency="IDR" onClick="this.select();" />
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <label class="col-sm-6 col-form-label">{{ __('Tunjangan PPh') }}</label>
                                    <div class="col-sm-6">
                                        <input wire:model.lazy="input.pph_allowance" class="form-control text-end" format-currency="IDR" onClick="this.select();" />
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <label class="col-sm-6 col-form-label fw-bold">{{ __('Jumlah Penghasilan Bruto') }}</label>
                                    <div class="col-sm-6">
                                        <input wire:model="input.total_gross" class="form-control text-end fw-bold" format-currency="IDR" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row gy-3 gy-lg-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header fw-bold">{{ __('Pengurang') }}</div>
                                    <div class="card-body d-grid gap-2 gap-sm-3">
                                        <div class="row align-items-center">
                                            <label class="col-sm-6 col-form-label">{{ __('Iuran Pensiun (Premi JHT + JP)') }}</label>
                                            <div class="col-sm-6">
                                                <input wire:model.lazy="input.pension_contribution" class="form-control text-end" format-currency="IDR" onClick="this.select();" />
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <label class="col-sm-6 col-form-label">{{ __('Biaya Jabatan') }}</label>
                                            <div class="col-sm-6">
                                                <input wire:model="input.position_cost" class="form-control text-end" format-currency="IDR" disabled />
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <label class="col-sm-6 col-form-label fw-bold">{{ __('Jumlah Penghasilan Neto') }}</label>
                                            <div class="col-sm-6">
                                                <input wire:model="input.total_net" class="form-control text-end fw-bold" format-currency="IDR" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 {{ !$isVisible ? '' : 'd-none' }}">
                                <div class="d-flex justify-content-center justify-content-lg-start">
                                    <x-button-loading wire:click="submit" class="btn-primary">{{ __('Hitung') }}</x-button-loading>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ $isVisible ? '' : 'd-none' }}" id="result">
                <div class="card">
                    {{-- <div class="card-header fw-bold">{{ __('Hasil') }}</div> --}}
                    <div class="card-body d-grid gap-2 gap-sm-3">
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Penghasilan Disetahunkan') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.total_net_year" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Penghasilan Tidak Kena Pajak') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.ptkp_year" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Penghasilan Kena Pajak') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.pkp_year" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('PPh 21 Terutang (Setahun)') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.tax_payable_year" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('PPh 21 Atas Gaji Bulan ini') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.tax_payable_month" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label">{{ __('Potongan PPh 21 Atas Bonus/THR') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.tax_discount" class="form-control text-end" format-currency="IDR" disabled />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label class="col-sm-6 col-form-label fw-bold">{{ __('Jumlah PPh 21 Bulan ini') }}</label>
                            <div class="col-sm-6">
                                <input wire:model="result.total_tax_month" class="form-control text-end fw-bold" format-currency="IDR" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button wire:click="clear" class="btn btn-secondary">{{ __('Refresh') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
