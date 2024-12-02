<x-filament-panels::page>

    <div class="emp_first-row">

    	<div class="emp_profile-header">

        	{{-- Profile Image --}}
        	<div class="emp_profile-photo">
            	<img
                	src="{{ $employee->image_url ? asset('storage/' . $employee->image_url) : asset('assets/images/panels/admin.svg') }}"
                	alt="Profile Image">
        	</div>

        	{{-- Profile Info --}}
        	<div class="emp_info-card">

            	{{-- Update Profile Image Modal --}}
            	<div class="emp_modal-container">

                	<x-filament::modal
                    	icon="heroicon-o-photo"
                    	icon-color="success"
                    	alignment="start"
                    	sticky-header
                    	sticky-footer
                	>

                    	<x-slot name="trigger">
                        	<x-heroicon-o-pencil-square
                            	class="w-5 h-5"
                            	style="color: #5fad56;"
                        	/>
                    	</x-slot>

                    	<x-slot name="heading">
                        	{{ __('panels.change_profile_image') }}
                    	</x-slot>

                    	<x-slot name="description">
                        	{{ __('panels.upload_a_jpg,_png,_jpeg_file') }}.
                    	</x-slot>

                    	{{-- Modal content --}}
                    	<x-filament::input.wrapper>
                        	<x-filament::input
                            	type="file"
                            	wire:model="newImage"
                        	/>
                    	</x-filament::input.wrapper>

                    	<x-slot name="footerActions">
                        	<x-filament::button wire:click="saveImage">
                            	{{ __('panels.save') }}
                        	</x-filament::button>
                    	</x-slot>

                	</x-filament::modal>

            	</div>

                <div id="emp_full-name">
            	    <h2>
                	    {{ $employee->first_name }} {{ $employee->last_name }}
            	    </h2>
                </div>
            	<p>{{ $employee->name }}</p>
            	<p>{{ $employee->email }}</p>
            	<p>
                	{{ $employee->country_code }} {{ $employee->phone_number }}
            	</p>
        	</div>

    	</div>

        <div class="emp_aside-container">
            @livewire($this->getCalendarWidget())
        </div>

    </div>

    {{-- Profile Information --}}
    <div class="emp_info-section">
        <h3>{{ __('panels.personal_information') }}</h3>
        <div class="emp_info-container">
            <div>
                <p class="emp_item-title">{{ __('models.identification_number') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->identification_number }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.role') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->role }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.first_name') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->first_name }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.last_name') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->last_name }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.date_of_birth') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->birth }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.gender') }}:</p>
                <p class="emp_item-subtitle">{{ $employee->gender }}</p>
            </div>
        </div>
    </div>

    {{-- Address Information --}}
    <div class="emp_info-section">
        <h3>{{ __('panels.address_information') }}</h3>
        <div class="emp_info-container">
            <div>
                <p class="emp_address-title">{{ __('models.country') }}:</p>
                <p class="emp_address-subtitle">{{ $employee->country }}</p>
            </div>
            <div>
                <p class="emp_address-title">{{ __('models.city') }}:</p>
                <p class="emp_address-subtitle">{{ $employee->city }}</p>
            </div>
            <div>
                <p class="emp_address-title">{{ __('models.postal_code') }}</p>
                <p class="emp_address-subtitle">{{ $employee->postal_code }}</p>
            </div>
        </div>
        <div style="padding-top: 20px;">
            <p class="emp_address-title">{{ __('models.address') }}:</p>
            <p class="emp_address-subtitle">{{ $employee->address }}</p>
        </div>
    </div>

    {{-- Job Information --}}
    <div class="emp_info-section">
        <h3>{{ __('panels.employee_information') }}</h3>
        <div class="emp_info-container">
            <div>
                <p class="emp_item-title">{{ __('models.hire_date') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->hire_date }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.social_security_number') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->social_security_number }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.contract_type') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->contract_type }}</p>
            </div>
            <div>
                <p class="emp_item-title">
                    {{ __('models.work_permit') }}
                </p>
                @if ($employee->work_permit === 1)
                    <p class="emp_item-subtitle">
                        Si posee.
                    </p>
                @else
                    <p class="emp_item-subtitle">
                        No posee.
                    </p>
                @endif

            </div>
            <div>
                <p class="emp_item-title">{{ __('models.supervisor') }}</p>
                @if ($employeeInfo->supervisor)
                    <p class="emp_item-subtitle">{{ $employeeInfo->supervisor }}</p>
                @else
                    <p class="emp_item-subtitle">Not assigned</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Bank Information --}}
    <div class="emp_info-section">
        <h3>Bank Information</h3>
        <div class="emp_info-container">
            <div>
                <p class="emp_item-title">{{ __('models.bank_name') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->bank_name }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.bank_code') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->bank_code }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.account_type') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->account_type }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.account_number') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->account_number }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.routing_number') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->routing_number }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.iban') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->iban }}</p>
            </div>
        </div>
    </div>

    {{-- Salary Info --}}
    <div class="emp_info-section">
        <h3>Salary Information</h3>
        <div class="emp_info-container">
            <div>
                <p class="emp_item-title">{{ __('models.currency_symbol') }}</p>
                <p class="emp_item-subtitle">{{ $salary->currency_symbol }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.base_salary') }}</p>
                <p class="emp_item-subtitle">{{ $salary->base_salary }}</p>
            </div>
            <div>
                <p class="emp_item-title">{{ __('models.salary_type') }}</p>
                <p class="emp_item-subtitle">{{ $salary->salary_type }}</p>
            </div>
        </div>
    </div>

    <style>

        .emp_first-row {
            /*display: flex;*/
            display: grid;
            grid-template-columns: 2fr 1fr;
            /*max-width: 1000px;*/
            max-width: 100%;
            /*gap: 15px;*/
            /*justify-content: space-between;*/
        }
        .emp_aside-container {
            display: flex;
            border-radius: 20px;
            width: 100%;
            /*padding: 10px 10px;*/
            /*flex-grow: 1;*/
        }
        /* Profile Header */
        .emp_profile-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            /*background-color: #ffeee4;*/
            background-color: #fff;
            border-radius: 20px;
            margin-right: 15px;
            /*max-width: 600px;*/
            /*max-height: 600px;*/
            /*max-width: 1000px;*/
            /*padding: 20px;*/
            padding: 40px 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .emp_profile-photo {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            /*background-color: white;*/
            overflow: hidden;
        }
        .emp_profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .emp_info-card {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 10px 10px;
        }
        #emp_full-name {
            display: flex;
            flex-wrap: wrap;
        }
        #emp_full-name h2 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }
        .emp_info-card p {
            font-size: 1rem;
            color: #555;
        }
        /* Update Profile Modal */
        .emp_modal-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        /* Information Styles */
        .emp_info-section {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            max-width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .emp_info-section h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .emp_info-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .emp_item-title {
            font-weight: bold;
            color: #333;
        }
        .emp_item-subtitle {
            color: #555;
        }
        .emp_address-title {
            font-weight: bold;
            color: #333;
        }
        .emp_address-subtitle {
            color: #555;
        }
        @media(max-width: 1235px){
            .emp_aside-container {
                display: none;
            }
        }
        @media(max-width: 535px) {
            .emp_aside-container {
                display: flex;
            }
        }
        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .emp_first-row {
                display: flex;
                flex-direction: column;
            }
            .emp_aside-container {
                display: none;
            }
            .emp_profile-header {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 10px;
                max-width: 100%;
                margin-right: 0px;
            }
            .emp_profile-photo {
                border-radius: 50%;
            }
            .emp-info-card {
                justify-content: center;
                align-items: center;
            }
            .emp_info-section {
                display: grid;
                grid-template-columns: 1fr;
            }
            .emp_info-container {
                display: grid;
                grid-template-columns: 1fr;
            }
        }

    </style>

</x-filament-panels::page>

