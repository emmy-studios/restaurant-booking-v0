<div class="emp_notice-container">

    @php
        $notice->is_read = true;
        $notice->update();
    @endphp

    <div class="emp_header-container">
        {{-- Notice Icon --}}
        <div class="emp_notice-image">
            <img src="{{ asset('assets/images/panels/notice_icon.svg') }}" alt="Notice Icon">
        </div>
        {{-- Header Info --}}
        <div class="emp_header-info">
            <!--<h2 class="emp_notice-subject">{{ $notice->subject }}</h2>-->
            <p class="emp_notice-type">{{ $notice->type }}</p>
            <span class="emp_notice-date">{{ $notice->date }}</span>
        </div>
    </div>
    {{-- Message Content --}}
    <div class="emp_message-container">
        <h2 class="emp_notice-subject">{{ $notice->subject }}</h2>
        <p>{{ $notice->message }}</p>
    </div>

</div>

<style>

    .emp_notice-container {
        dispay: flex;
        flex-direction: column;
    }
    .emp_header-container {
        background-color: #f9f9f9; /* Fondo claro */
        border: 1px solid #e0e0e0; /* Borde suave */
        border-radius: 8px; /* Bordes redondeados */
        padding: 20px;
        max-width: 500px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        margin: 20px auto; /* Centrado */
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .emp_notice-image img {
        height: 50px;
        width: 50px;
        object-fit: contain;
        margin: 0 auto;
    }
    .emp_header-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
        text-align: center;
    }
    .emp_notice-subject {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .emp_notice-type {
        font-size: 0.9rem;
        font-weight: 500;
        color: #555;
        text-transform: uppercase;
        margin: 0;
    }
    .emp_notice-date {
        font-size: 0.8rem;
        font-weight: 400;
        color: #888;
    }
    .emp_message-container {
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        max-width: 500px;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
        color: #333;
    }

</style>



