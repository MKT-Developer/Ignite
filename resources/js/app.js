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

// ==============================
// CHECK-IN
// ==============================
const checkInProcess = {
    process: [
        {
            title: "Hospedados en Hilton Garden Inn",
            steps: [
                {
                    time: "7:00 - 7:40",
                    activity: "Desayuno",
                    location: "Hilton Garden Inn"
                },
                {
                    time: "7:50 - 8:00",
                    activity: "Aborde al transporte",
                    location: "Hilton Garden Inn"
                },
                {
                    time: "8:00 - 8:30",
                    activity: "Transporte",
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:30 - 9:20",
                    activity: "Check-in",
                    location: "Hilton All-Inclusive"
                }
            ]
        },
        {
            title: "Llegada directa a Hilton All-Inclusive",
            steps: [
                {
                    time: "7:30 - 8:00",
                    activity: "Check-in",
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:00 - 9:00",
                    activity: "Desayuno",
                    location: "Hilton All-Inclusive"
                }
            ]
        }
    ]
};

function renderCheckInProcess() {
    const container = document.getElementById('schedule-list');
    if (!container) return;

    container.innerHTML = checkInProcess.process.map(process => `
        <div class="checkin-process">
            <div class="checkin-process-title">${process.title}</div>

            <div class="checkin-table">
                <div class="checkin-header">
                    <div>Horario</div>
                    <div>Actividad</div>
                    <div>Ubicación</div>
                </div>

                ${process.steps.map(step => `
                    <div class="checkin-row">
                        <div class="checkin-time" data-label="Horario">${step.time}</div>
                        <div class="checkin-activity" data-label="Actividad">${step.activity}</div>
                        <div class="checkin-location" data-label="Ubicación">${step.location}</div>
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
        title: "Lunes 31 de Agosto",
        subtitle: "Día 1",
        activities: [
            { time: "09:00 – 10:00", activity: "Registro y entrega de gafetes", location: "Salón Azul A" },
            { time: "10:00 – 11:00", activity: "Mensaje de Presidencia", location: "Salón Azul A" },
            { time: "11:00 – 12:00", activity: "Overview operativo", location: "Salón Azul A" },
            { time: "12:00 – 13:00", activity: "Overview administrativo", location: "Salón Azul A" },
            { time: "13:00 – 15:00", activity: "Comida buffet", location: "Restaurante Vela" },
            { time: "15:00 – 17:00", activity: "Panel de Centro de Soporte", location: "Salón Azul A" },
            { time: "17:00 – 18:00", activity: 'Conferencia "Break to Build" · Rodrigo del Val', location: "Salón Azul A" },
            { time: "18:00 – 19:00", activity: "Tiempo libre", location: "—" },
            { time: "20:00", activity: "Cena por restaurante", location: "Restaurantes del hotel" }
        ]
    },

    day2: {
        title: "Martes 1 de Septiembre",
        subtitle: "Día 2",
        activities: [
            { time: "07:30 – 08:50", activity: "Desayuno", location: "Restaurante del hotel" },
            { time: "09:00 – 10:00", activity: "Bienvenida y actividad de networking", location: "Salón Azul A" },
            { time: "10:00 – 14:00", activity: "Taller: Planeación Estratégica · Rodrigo del Val", location: "Salón Azul A" },
            { time: "14:00 – 15:00", activity: "Comida buffet", location: "Restaurante Vela" },
            { time: "15:00 – 19:00", activity: "Taller: Inteligencia Artificial · Jesús Vargas", location: "Salón Azul A" },
            { time: "20:00", activity: "Cena por restaurante", location: "Restaurantes del hotel" }
        ]
    },

    day3: {
        title: "Miércoles 2 de Septiembre",
        subtitle: "Día 3 · Cena de Gala",
        activities: [
            { time: "07:30 – 08:50", activity: "Desayuno", location: "Restaurante del hotel" },
            { time: "09:00 – 10:00", activity: "Bienvenida y actividad de networking", location: "Salón Azul A" },
            { time: "10:00 – 14:00", activity: "Taller: Presupuesto Operativo Efectivo · Fernando Rodríguez", location: "Salón Azul A" },
            { time: "14:00 – 15:00", activity: "Comida buffet", location: "Restaurante Vela" },
            { time: "15:00 – 16:00", activity: "Sesión de proveedores", location: "Salón Azul A" },
            { time: "16:00 – 17:00", activity: "Buenas prácticas · Gustavo Hernández", location: "Salón Azul A" },
            { time: "17:00 – 18:00", activity: "Buenas prácticas de operación · Michael Taylor", location: "Salón Azul A" },
            { time: "18:00 – 18:20", activity: "Cierre del evento", location: "Salón Azul A" },
            { time: "18:20 – 20:00", activity: "Tiempo para arreglarte", location: "Habitaciones" },
            { time: "20:00 – 00:00", activity: "Cena de Gala", location: "Salón de Cena" }
        ]
    },

    day4: {
        title: "Jueves 3 de Septiembre",
        subtitle: "Salidas · Huéspedes del Hilton",
        activities: [
            { time: "Antes de tu salida", activity: "Check-out y resguardo de maletas", location: "Lobby" },
            { time: "03:00", activity: "Salida 1 — Aeropuerto", location: "Lobby" },
            { time: "05:30", activity: "Salida 2 — Aeropuerto", location: "Lobby" },
            { time: "07:30", activity: "Salida 3 — Aeropuerto", location: "Lobby" },
            { time: "09:00", activity: "Salida 4 — Aeropuerto", location: "Lobby" },
            { time: "11:00", activity: "Salida 5 — Aeropuerto", location: "Lobby" }
        ]
    }
};

function renderEventSchedule(day) {
    const container = document.getElementById('event-schedule-list');
    if (!container) return;

    const currentDay = eventSchedule[day];
    if (!currentDay) return;

    container.innerHTML = `
        <div class="schedule-day">
            <div class="schedule-day-header">
                <h3>${currentDay.title}</h3>
                <span>${currentDay.subtitle}</span>
            </div>

            <div class="event-table">
                <div class="event-header">
                    <div>Horario</div>
                    <div>Actividad</div>
                    <div>Lugar</div>
                </div>

                ${currentDay.activities.map(item => `
                    <div class="event-row">
                        <div class="event-time" data-label="Horario">${item.time}</div>
                        <div class="event-activity" data-label="Actividad">${item.activity}</div>
                        <div class="event-location" data-label="Lugar">${item.location}</div>
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