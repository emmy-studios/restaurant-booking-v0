<x-filament-panels::page>

    <div class="emp_header-information">

        <div class="emp_photo-container">

                <img
                    src="{{ $employee->image_url ? asset('storage/' . $employee->image_url) : asset('assets/images/panels/admin_profile.png') }}"
                    alt="Profile Image">
        </div>


    </div>

    <style>

        .emp_photo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: red;
            overflow: hidden;
        }
        .emp_photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>

</x-filament-panels::page>
