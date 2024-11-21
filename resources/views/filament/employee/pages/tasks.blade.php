<x-filament-panels::page>

    @foreach($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

    <x-filament::section
        icon="heroicon-o-information-circle"
        icon-color="warning"
        collapsible
        collapsed
    >

        <x-slot name="heading">
            {{ __('panels.task_status') }}
        </x-slot>

        <x-slot name="description">
            <span>
                Cada tarea asignada a un empleado tiene un estado especifico, el cual varía durante el
                proceso de realización de la tarea.
            </span>
        </x-slot>

        {{-- Content --}}
        <div class="emp_help-container">

            <div class="emp_help-header">
                <p>
                    Estados posibles de cada tarea y una breve explicación de este y su lugar en
                    el proceso de creación, realización, supervisión y aprobación de la tarea.
                </p>
            </div>

            <div class="emp_help-content">
                {{-- PENDING STATUS --}}
                <div class="emp_info-header">
                    <h2>1. </h2>
                    <span id="emp_first-status">Pending</span>
                    <h3>(Pending)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Una tarea asignada al empleado, pero en la que aún no ha trabajado.
                    </p>
                    <p>
                        -> Ideal para tareas recién asignadas.
                    </p>
                </div>
                {{-- IN_PROGRESS STATUS --}}
                <div class="emp_info-header">
                    <h2>2. </h2>
                    <span id="emp_second-status">In Progress</span>
                    <h3>(In Progress)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Indica que el empleado está trabajando activamente en la tarea.
                    </p>
                </div>
                {{-- COMPLETED STATUS --}}
                <div class="emp_info-header">
                    <h2>3. </h2>
                    <span id="emp_third-status">Completed</span>
                    <h3>(Completed)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Cuando el empleado termina su trabajo y marca la tarea como terminada.
                    </p>
                </div>
                {{-- CANCELLED STATUS --}}
                <div class="emp_info-header">
                    <h2>4. </h2>
                    <span id="emp_fourth-status">Cancelled</span>
                    <h3>(Cancelled)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Se utiliza para tareas que ya no necesitan completarse por algún motivo.
                    </p>
                </div>
                {{-- REVIEW_PENDING STATUS --}}
                <div class="emp_info-header">
                    <h2>5. </h2>
                    <span id="emp_fifth-status">Review Pending</span>
                    <h3>(Review Pending)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Este nuevo estado marca las tareas terminadas por el
                        empleado pero que están esperando ser revisadas por un supervisor.
                    </p>
                    <p>
                        -> Es útil para garantizar que las tareas finalizadas pasan
                        por una revisión antes de ser aceptadas como completadas.
                    </p>
                </div>
                {{-- REVIEWED STATUS --}}
                <div class="emp_info-header">
                    <h2>6. </h2>
                    <span id="emp_sixth-status">Reviewed</span>
                    <h3>(Reviewed)</h3>
                </div>
                <div class="emp_status-explanation">
                    <p>
                        -> Un estado que indica que el supervisor revisó y aprobó o
                        rechazó la tarea. Puede ser un estado final o intermedio dependiendo de tu flujo.
                    </p>
                </div>

            </div>

        </div>

    </x-filament::section>

    <style>
        .emp_help-content {
            margin-top: 30px;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
        }
        .emp_info-header {
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
        #emp_first-status {
            padding: 3px 4px;
            border: 1px solid #fb8159;
            border-radius: 5px;
            font-size: 10px;
            background-color: #fb8159;
            color: white;
        }
        #emp_second-status {
            padding: 3px 4px;
            border: 1px solid #88a2ff;
            border-radius: 5px;
            font-size: 10px;
            background-color: #88a2ff;
            color: white;
        }
        #emp_third-status {
            padding: 3px 4px;
            border: 1px solid green;
            border-radius: 5px;
            font-size: 10px;
            background-color: green;
            color: white;
        }
        #emp_fourth-status {
            padding: 3px 4px;
            border: 1px solid red;
            border-radius: 5px;
            font-size: 10px;
            background-color: #EE4B2B;
            color: white;
        }
        #emp_fifth-status {
            padding: 3px 4px;
            border: 1px solid #d35ba5;
            border-radius: 5px;
            font-size: 10px;
            background-color: #d35ba5;
            color: white;
        }
        #emp_sixth-status {
            padding: 3px 4px;
            border: 1px solid #25a244;
            border-radius: 5px;
            font-size: 10px;
            background-color: #25a244;
            color: white;
        }
        .emp_status-explanation {
            display: flex;
            flex-direction: column;
            margin: 20px 40px;
        }
    </style>

</x-filament-panels::page>
