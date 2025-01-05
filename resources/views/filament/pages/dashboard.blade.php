<x-filament-panels::page>

    <div class="date-container">
        <p>
            {{ $currentDate }}
        </p>
    </div>

    <div class="hero-card">
        <div class="message-column">
            <h1>
                {{ __('Welcome Back') }}, {{ $adminInfo->name }}!
            </h1>
            <p>
                {{ __('Monitor, manage, and streamline your operations seamlessly from this central hub. All the tools you need are just a click away.') }}
            </p>
        </div>
        <div class="image-column">
            <!--<img src="{{ asset('assets/images/panels/background01.png') }}" alt="Dashboard Illustration">-->
            <img src="{{ asset('assets/images/system/store01.svg') }}">
        </div>
    </div>

    <div class="filament-widgets">
        @foreach($this->getWidgets() as $widget)
            <div class="widget-container">
                @livewire($widget)
            </div>
        @endforeach
    </div>

    <style>

        .date-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .date-container p {
            font-weight: bold;
            color: #E77917;
        }
        .hero-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            align-items: center;
            margin-bottom: 20px;
        }
        .message-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .message-column h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
        .message-column p {
            font-size: 1rem;
            color: #555;
        }
        .image-column {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .message-column img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .filament-widgets {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .widget-container {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr;
            }
            h1 {
                font-size: 1.5rem;
            }
            p {
                font-size: 0.95rem;
            }
            a {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</x-filament-panels::page>

