<x-filament-panels::page>

    <div class="emp_first-row">

    	<div class="emp_profile-header">

        	{{-- Profile Image --}}
        	<div class="emp_profile-photo">
            	<img
                	src="{{ $employee->image_url ? asset('storage/' . $employee->image_url) : asset('assets/images/panels/admin_profile.png') }}"
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
                            	style="color: #E77917;"
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
            <p>{{ $employeeInfo->identification_code }}</p>
        </div>

    </div>

    {{-- Profile Information --}}
    <div class="emp_personal-information">
        <h3>{{ __('panels.personal_information') }}</h3>
        <div class="emp_personal-information-container">
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
    <div class="emp_address-info">
        <h3>{{ __('panels.address_information') }}</h3>
        <div class="emp_address-info-container">
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
    <div class="emp_job-info">
        <h3>{{ __('panels.employee_information') }}</h3>
        <div class="emp_job-container">
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
                <p class="emp_item-title">{{ __('models.work_permit') }}</p>
                <p class="emp_item-subtitle">{{ $employeeInfo->work_permit }}</p>
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
    <div class="emp_bank-info">
        <h3>Bank Information</h3>
        <div>
        </div>
    </div>

    {{-- Salary Info --}}
    <div class="emp_salary-info">
        <h3>Salary Information</h3>
    </div>

    <style>

        .emp_first-row {
            display: flex;
            max-width: 1000px;
            gap: 15px;
            justify-content: space-between;
        }
        .emp_aside-container {
            display: flex;
            background-color: #fcac5d;
            border-radius: 20px;
            padding: 10px 10px;
            flex-grow: 1;
        }
        /* Profile Header */
        .emp_profile-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            background-color: #ffeee4;
            border-radius: 20px;
            max-width: 600px;
            /*max-height: 600px;*/
            /*max-width: 1000px;*/
            /*padding: 20px;*/
            padding: 40px 40px;
            /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);*/
        }
        .emp_profile-photo {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 300px;
            height: 300px;
            border-radius: 10px;
            background-color: white;
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
        /* Personal Information */
        .emp_personal-information {
            /*background-color: #fff;*/
            background-color: #ffe69e;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
            /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        }
        .emp_personal-information h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .emp_personal-information-container {
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
        /* Address Information */
        .emp_address-info {
            background-color: #ffe69e;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
            /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
        }
        .emp_address-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .emp_address-info-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .emp_address-title {
            font-weight: bold;
            color: #333;
        }
        .emp_address-subtitle {
            color: #555;
        }

        /* Job Information */
        .emp_job-info {
            background-color: #ffe69e;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
        }
        .emp_job-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .emp_job-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Bank Information */
        .emp_bank-info {
            background-color: #ffe69e;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
        }
        .emp_bank-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Salary Information */
        .emp_salary-info {
            background-color: #ffe69e;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
        }
        .emp_salary-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .emp_first-row {
                display: flex;
                flex-direction: column;
            }
            .emp_profile-header {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 10px;
                max-width: 100%;
            }
            .emp_profile-photo {
                border-radius: 50%;
            }
            .emp-info-card {
                justify-content: center;
                align-items: center;
            }
            .emp_personal-information-container {
                display: grid;
                grid-template-columns: 1fr;
            }
            .emp_address-info-container {
                display: grid;
                grid-template-columns: 1fr;
            }
        }

    </style>

</x-filament-panels::page>

