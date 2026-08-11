import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('keydown', function (e) {
    if (e.key === 'PrintScreen') {
        navigator.clipboard.writeText('');
        alert('Captura de pantalla deshabilitada.');
    }
    if (e.ctrlKey && (e.key === 'u' || e.key === 's')) {
        e.preventDefault();
        alert('Acción no permitida.');
    }
    if (e.key === 'F12') {
        e.preventDefault();
    }
});

// Overlay cuando pierde foco
document.addEventListener('visibilitychange', function () {
    const overlay = document.getElementById('anti-screenshot-overlay');
    if (document.hidden) {
        overlay.style.display = 'block';
    } else {
        overlay.style.display = 'none';
    }
});

$(function () {

    const pcoded = document.getElementById('pcoded');

    if (!pcoded) return;

    function toggleBodyScroll() {
        if (window.innerWidth > 992) {
            $('body').css('overflow', '');
            return;
        }

        const navType = pcoded.getAttribute('vertical-nav-type');

        if (navType === 'expanded') {
            $('body').css('overflow', 'hidden');
        } else {
            $('body').css('overflow', '');
        }
    }

    // Estado inicial
    toggleBodyScroll();

    // Escuchar cambios del atributo
    const observer = new MutationObserver(function () {
        toggleBodyScroll();
    });

    observer.observe(pcoded, {
        attributes: true,
        attributeFilter: ['vertical-nav-type']
    });

    // Recalcular al cambiar tamaño de pantalla
    $(window).on('resize', function () {
        toggleBodyScroll();
    });

});

$(".mobile-options").on('click', function () {

    if ($(window).width() <= 992) {
        $(".navbar-container .nav-right").slideToggle('slow');
    }

});

// ============================================
// TRADUCCION DE CHECK-IN & PROGRAMA DEL EVENTO
// ============================================
const portalTranslations = JSON.parse(
    document.getElementById('portal-translations').textContent
);

// ==============================
// CHECK-IN
// ==============================

const checkInProcess = {
    process: [
        {
            title: portalTranslations.checkin.hosted_hilton_garden,
            steps: [
                {
                    time: "7:00 - 7:40",
                    activity: portalTranslations.checkin.breakfast,
                    location: "Hilton Garden Inn"
                },
                {
                    time: "7:50 - 8:00",
                    activity: portalTranslations.checkin.board_transport,
                    location: "Hilton Garden Inn"
                },
                {
                    time: "8:00 - 8:30",
                    activity: portalTranslations.checkin.transport,
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:30 - 9:20",
                    activity: portalTranslations.checkin.check_in,
                    location: "Hilton All-Inclusive"
                }
            ]
        },
        {
            title: portalTranslations.checkin.direct_arrival,
            steps: [
                {
                    time: "7:30 - 8:00",
                    activity: portalTranslations.checkin.check_in,
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:00 - 9:00",
                    activity: portalTranslations.checkin.breakfast,
                    location: "Hilton All-Inclusive"
                }
            ]
        }
    ]
};

function renderCheckInProcess() {
    const container = document.getElementById('schedule-list');
    if (!container) return;

    const t = portalTranslations.checkin;

    container.innerHTML = checkInProcess.process.map(process => `
        <div class="checkin-process">
            <div class="checkin-process-title">${process.title}</div>

            <div class="checkin-table">
                <div class="checkin-header">
                    <div>${t.schedule}</div>
                    <div>${t.activity}</div>
                    <div>${t.location}</div>
                </div>

                ${process.steps.map(step => `
                    <div class="checkin-row">
                        <div class="checkin-time" data-label="${t.schedule}">
                            ${step.time}
                        </div>

                        <div class="checkin-activity" data-label="${t.activity}">
                            ${step.activity}
                        </div>

                        <div class="checkin-location" data-label="${t.location}">
                            ${step.location}
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');
}


// ==============================
// PROGRAMA DEL EVENTO
// ==============================

const eventSchedule = {
    day1: {
        title: portalTranslations.eventSchedule.day1.title,
        subtitle: portalTranslations.eventSchedule.day1.subtitle,

        activities: [
            {
                time: "09:00 – 10:00",
                activity: portalTranslations.eventSchedule.day1.activities.registration,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "10:00 – 11:00",
                activity: portalTranslations.eventSchedule.day1.activities.presidency_message,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "11:00 – 12:00",
                activity: portalTranslations.eventSchedule.day1.activities.operational_overview,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "12:00 – 13:00",
                activity: portalTranslations.eventSchedule.day1.activities.administrative_overview,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "13:00 – 15:00",
                activity: portalTranslations.eventSchedule.day1.activities.buffet_lunch,
                location: portalTranslations.eventSchedule.day1.locations.vela_restaurant
            },
            {
                time: "15:00 – 17:00",
                activity: portalTranslations.eventSchedule.day1.activities.support_center_panel,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "17:00 – 18:00",
                activity: portalTranslations.eventSchedule.day1.activities.break_to_build,
                location: portalTranslations.eventSchedule.day1.locations.blue_room
            },
            {
                time: "18:00 – 19:00",
                activity: portalTranslations.eventSchedule.day1.activities.free_time,
                location: portalTranslations.eventSchedule.day1.locations.none
            },
            {
                time: "20:00",
                activity: portalTranslations.eventSchedule.day1.activities.dinner_by_restaurant,
                location: portalTranslations.eventSchedule.day1.locations.hotel_restaurants
            }
        ]
    },

    day2: {
        title: portalTranslations.eventSchedule.day2.title,
        subtitle: portalTranslations.eventSchedule.day2.subtitle,

        activities: [
            {
                time: "07:30 – 08:50",
                activity: portalTranslations.eventSchedule.day2.activities.breakfast,
                location: portalTranslations.eventSchedule.day2.locations.hotel_restaurant
            },
            {
                time: "09:00 – 10:00",
                activity: portalTranslations.eventSchedule.day2.activities.welcome_networking,
                location: portalTranslations.eventSchedule.day2.locations.blue_room
            },
            {
                time: "10:00 – 14:00",
                activity: portalTranslations.eventSchedule.day2.activities.strategic_planning,
                location: portalTranslations.eventSchedule.day2.locations.blue_room
            },
            {
                time: "14:00 – 15:00",
                activity: portalTranslations.eventSchedule.day2.activities.buffet_lunch,
                location: portalTranslations.eventSchedule.day2.locations.vela_restaurant
            },
            {
                time: "15:00 – 19:00",
                activity: portalTranslations.eventSchedule.day2.activities.artificial_intelligence,
                location: portalTranslations.eventSchedule.day2.locations.blue_room
            },
            {
                time: "20:00",
                activity: portalTranslations.eventSchedule.day2.activities.dinner_by_restaurant,
                location: portalTranslations.eventSchedule.day2.locations.hotel_restaurants
            }
        ]
    },

    day3: {
        title: portalTranslations.eventSchedule.day3.title,
        subtitle: portalTranslations.eventSchedule.day3.subtitle,

        activities: [
            {
                time: "07:30 – 08:50",
                activity: portalTranslations.eventSchedule.day3.activities.breakfast,
                location: portalTranslations.eventSchedule.day3.locations.hotel_restaurant
            },
            {
                time: "09:00 – 10:00",
                activity: portalTranslations.eventSchedule.day3.activities.welcome_networking,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "10:00 – 14:00",
                activity: portalTranslations.eventSchedule.day3.activities.effective_operating_budget,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "14:00 – 15:00",
                activity: portalTranslations.eventSchedule.day3.activities.buffet_lunch,
                location: portalTranslations.eventSchedule.day3.locations.vela_restaurant
            },
            {
                time: "15:00 – 16:00",
                activity: portalTranslations.eventSchedule.day3.activities.suppliers_session,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "16:00 – 17:00",
                activity: portalTranslations.eventSchedule.day3.activities.best_practices,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "17:00 – 18:00",
                activity: portalTranslations.eventSchedule.day3.activities.operational_best_practices,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "18:00 – 18:20",
                activity: portalTranslations.eventSchedule.day3.activities.event_closing,
                location: portalTranslations.eventSchedule.day3.locations.blue_room
            },
            {
                time: "18:20 – 20:00",
                activity: portalTranslations.eventSchedule.day3.activities.get_ready,
                location: portalTranslations.eventSchedule.day3.locations.rooms
            },
            {
                time: "20:00 – 00:00",
                activity: portalTranslations.eventSchedule.day3.activities.gala_dinner,
                location: portalTranslations.eventSchedule.day3.locations.dinner_room
            }
        ]
    },

    day4: {
        title: portalTranslations.eventSchedule.day4.title,
        subtitle: portalTranslations.eventSchedule.day4.subtitle,

        activities: [
            {
                // time: "Antes de tu salida",
                time: portalTranslations.eventSchedule.day4.activities.before_departure,
                activity: portalTranslations.eventSchedule.day4.activities.checkout_luggage,
                location: portalTranslations.eventSchedule.day4.locations.lobby
            },
            {
                time: "03:00",
                activity: portalTranslations.eventSchedule.day4.activities.departure_airport.replace(':number', '1'),
                location: portalTranslations.eventSchedule.day4.locations.lobby
            },
            {
                time: "05:30",
                activity: portalTranslations.eventSchedule.day4.activities.departure_airport.replace(':number', '2'),
                location: portalTranslations.eventSchedule.day4.locations.lobby
            },
            {
                time: "07:30",
                activity: portalTranslations.eventSchedule.day4.activities.departure_airport.replace(':number', '3'),
                location: portalTranslations.eventSchedule.day4.locations.lobby
            },
            {
                time: "09:00",
                activity: portalTranslations.eventSchedule.day4.activities.departure_airport.replace(':number', '4'),
                location: portalTranslations.eventSchedule.day4.locations.lobby
            },
            {
                time: "11:00",
                activity: portalTranslations.eventSchedule.day4.activities.departure_airport.replace(':number', '5'),
                location: portalTranslations.eventSchedule.day4.locations.lobby
            }
        ]
    }
};


function renderEventSchedule(day) {
    const container = document.getElementById('event-schedule-list');
    if (!container) return;

    const currentDay = eventSchedule[day];
    if (!currentDay) return;

    const t = portalTranslations.eventSchedule;

    container.innerHTML = `
        <div class="schedule-day">
            <div class="schedule-day-header">
                <h3>${currentDay.title}</h3>
                <span>${currentDay.subtitle}</span>
            </div>

            <div class="event-table">
                <div class="event-header">
                    <div>${t.schedule}</div>
                    <div>${t.activity}</div>
                    <div>${t.location}</div>
                </div>

                ${currentDay.activities.map(item => `
                    <div class="event-row">
                        <div class="event-time" data-label="${t.schedule}">
                            ${item.time}
                        </div>

                        <div class="event-activity" data-label="${t.activity}">
                            ${item.activity}
                        </div>

                        <div class="event-location" data-label="${t.location}">
                            ${item.location}
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
}


function initEventScheduleNav() {
    const buttons = document.querySelectorAll('.schedule-nav button');
    if (!buttons.length) return;

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            renderEventSchedule(button.dataset.day);
        });
    });
}

// ==============================
// INIT
// ==============================
document.addEventListener('DOMContentLoaded', () => {
    renderCheckInProcess();

    if (document.getElementById('event-schedule-list')) {
        renderEventSchedule('day1');
        initEventScheduleNav();
    }
});