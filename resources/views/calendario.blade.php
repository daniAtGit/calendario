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
                    firstDay: 1,

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
                    },

                    dayCellContent: function(arg) {
                        let date = arg.date.toISOString().split('T')[0]; // formato YYYY-MM-DD
                        let url = "{{route('evento.nuovo')}}/"+date; // rotta dove vuoi puntare

                        return { html: '<a href="' + url + '">' + arg.dayNumberText + '</a>' };
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

{{--<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">--}}
    <div>

        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <i class="fa fa-2x fa-calendar"></i>
                    </div>



                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">



                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    <span class="small">Log in</span>
                                </a>

{{--                                @if (Route::has('register'))--}}
{{--                                    <a--}}
{{--                                        href="{{ route('register') }}"--}}
{{--                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                                    >--}}
{{--                                        Register--}}
{{--                                    </a>--}}
{{--                                @endif--}}
                            @endauth

                            <a href="{{route('evento.nuovo')}}" class="btn btn-sm btn-outline-secondary py-2">
                                <i class="fa fa-plus-circle"></i> Nuovo
                            </a>
                        </nav>
                    @endif
                </header>

                <main>

{{--                    <div class="text-end">--}}
{{--                        <a href="{{route('evento.nuovo')}}" class="btn btn-sm btn-outline-secondary">--}}
{{--                            <i class="fa fa-plus-circle"></i> Nuovo--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <br>--}}

                    <div id='calendar' style="padding:10px;background:#fff;"></div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
{{--                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})--}}
                </footer>
            </div>
        </div>
    </div>

</x-app-layout>
