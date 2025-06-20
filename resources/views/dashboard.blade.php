<x-app-layout>
    @section('headScripts')
        <!-- FullCalendar -->
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var SITEURL = "{{ url('/') }}";

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap5',
                    height: 'auto',

                    titleFormat:{
                        year: 'numeric',
                        month: 'long',
                    },

                    dayHeaderFormat: {
                        weekday: 'short',
                    },
                    initialView: 'dayGridMonth',

                    editable: false,
                    events: SITEURL + "/events",
                    displayEventTime: false,
                    selectable: true,
                    selectHelper: true,
                    locale: 'IT',
                    timeZone: 'UTC',

                    buttonText: {
                        today: 'Oggi',
                        list: 'Lista',
                        year: 'Anno',
                        month: 'Mese',
                    },

                    headerToolbar: {
                        start: 'title',
                        //center: '',
                        end: 'today'
                    },

                    footerToolbar: {
                        start: 'dayGridMonth,multiMonthYear,listMonth',
                        end: 'prev next',
                    }
                });

                calendar.setOption('locale', 'it');

                calendar.render();
            });
        </script>
    @stop

    @section('headScripts')
        <style>
            /* titolo calendario */
            .fc-toolbar-title{
                font-size: 1.2em !important;
            }
            /* celle calendario */
            .fc-col-header-cell-cushion, .fc-daygrid-day-number {
                text-decoration: none !important;
                color: inherit !important;
            }
        </style>
    @stop

{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div id='calendar' style="padding:10px;background:#fff;"></div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
