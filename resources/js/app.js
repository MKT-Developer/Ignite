import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/* ==============================================================
 * NOTA IMPORTANTE sobre el bloqueo de PrintScreen / Ctrl+S / Ctrl+U / F12
 * ==============================================================
 * Estas técnicas NO impiden capturas de pantalla ni acceso al código:
 * - No existe evento fiable para "PrintScreen" en todos los navegadores/SO.
 * - Limpiar el portapapeles no evita una captura hecha por el sistema
 *   operativo o por otra app (Snipping Tool, celular, etc.).
 * - Ctrl+U/Ctrl+S/F12 se pueden evadir por menú del navegador o DevTools
 *   remoto, y bloquearlos rompe funciones legítimas (guardar, ver código).
 * Se deja el comportamiento porque probablemente es un requisito de
 * negocio, pero se corrigen los errores técnicos (falta de manejo de
 * errores y de validación de elementos nulos).
 * ================================================================ */
(function () {
    document.addEventListener('keydown', function (e) {
        if (e.key === 'PrintScreen') {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText('').catch(() => {
                    // Sin permiso de portapapeles: no hacer nada, evitar error no capturado
                });
            }
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
        if (!overlay) return; // evita romper el script si el overlay no existe en esta vista
        overlay.style.display = document.hidden ? 'block' : 'none';
    });
})();

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

/**
 * Acceso seguro a propiedades anidadas.
 * Evita que un dato faltante en las traducciones tumbe todo el script.
 * Uso: t(portalTranslations, 'checkin.breakfast', 'Desayuno')
 */
function t(obj, path, fallback = '') {
    try {
        return path.split('.').reduce((acc, key) => (acc && acc[key] !== undefined ? acc[key] : undefined), obj) ?? fallback;
    } catch {
        return fallback;
    }
}

const translationsEl = document.getElementById('portal-translations');
const portalTranslations = translationsEl
    ? JSON.parse(translationsEl.textContent || '{}')
    : {};


// ==============================
// CHECK-IN
// ==============================

const checkInProcess = {
    process: [
        {
            title: t(portalTranslations, 'checkin.hosted_hilton_garden'),
            steps: [
                {
                    time: "7:00 - 7:40",
                    activity: t(portalTranslations, 'checkin.breakfast'),
                    location: "Hilton Garden Inn"
                },
                {
                    time: "7:50 - 8:00",
                    activity: t(portalTranslations, 'checkin.board_transport'),
                    location: "Hilton Garden Inn"
                },
                {
                    time: "8:00 - 8:30",
                    activity: t(portalTranslations, 'checkin.transport'),
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:30 - 9:20",
                    activity: t(portalTranslations, 'checkin.check_in'),
                    location: "Hilton All-Inclusive"
                }
            ]
        },
        {
            title: t(portalTranslations, 'checkin.direct_arrival'),
            steps: [
                {
                    time: "7:30 - 8:00",
                    activity: t(portalTranslations, 'checkin.check_in'),
                    location: "Hilton All-Inclusive"
                },
                {
                    time: "8:00 - 9:00",
                    activity: t(portalTranslations, 'checkin.breakfast'),
                    location: "Hilton All-Inclusive"
                }
            ]
        }
    ]
};

function renderCheckInProcess() {
    const container = document.getElementById('schedule-list');
    if (!container) return;

    const t_ = {
        schedule: t(portalTranslations, 'checkin.schedule'),
        activity: t(portalTranslations, 'checkin.activity'),
        location: t(portalTranslations, 'checkin.location')
    };

    container.innerHTML = checkInProcess.process.map(process => `
        <div class="checkin-process">
            <div class="checkin-process-title">${process.title}</div>

            <div class="checkin-table">
                <div class="checkin-header">
                    <div>${t_.schedule}</div>
                    <div>${t_.activity}</div>
                    <div>${t_.location}</div>
                </div>

                ${process.steps.map(step => `
                    <div class="checkin-row">
                        <div class="checkin-time" data-label="${t_.schedule}">
                            ${step.time}
                        </div>

                        <div class="checkin-activity" data-label="${t_.activity}">
                            ${step.activity}
                        </div>

                        <div class="checkin-location" data-label="${t_.location}">
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

function buildDay(dayKey) {
    return {
        title: t(portalTranslations, `eventSchedule.${dayKey}.title`),
        subtitle: t(portalTranslations, `eventSchedule.${dayKey}.subtitle`)
    };
}

const eventSchedule = {
    day1: {
        ...buildDay('day1'),
        activities: [
            { time: "09:00 – 10:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.registration'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "10:00 – 11:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.presidency_message'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "11:00 – 12:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.operational_overview'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "12:00 – 13:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.administrative_overview'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "13:00 – 15:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.buffet_lunch'), location: t(portalTranslations, 'eventSchedule.day1.locations.vela_restaurant') },
            { time: "15:00 – 17:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.support_center_panel'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "17:00 – 18:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.break_to_build'), location: t(portalTranslations, 'eventSchedule.day1.locations.blue_room') },
            { time: "18:00 – 19:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.free_time'), location: t(portalTranslations, 'eventSchedule.day1.locations.none') },
            { time: "20:00", activity: t(portalTranslations, 'eventSchedule.day1.activities.dinner_by_restaurant'), location: t(portalTranslations, 'eventSchedule.day1.locations.hotel_restaurants') }
        ]
    },

    day2: {
        ...buildDay('day2'),
        activities: [
            { time: "07:30 – 08:50", activity: t(portalTranslations, 'eventSchedule.day2.activities.breakfast'), location: t(portalTranslations, 'eventSchedule.day2.locations.hotel_restaurant') },
            { time: "09:00 – 10:00", activity: t(portalTranslations, 'eventSchedule.day2.activities.welcome_networking'), location: t(portalTranslations, 'eventSchedule.day2.locations.blue_room') },
            { time: "10:00 – 14:00", activity: t(portalTranslations, 'eventSchedule.day2.activities.strategic_planning'), location: t(portalTranslations, 'eventSchedule.day2.locations.blue_room') },
            { time: "14:00 – 15:00", activity: t(portalTranslations, 'eventSchedule.day2.activities.buffet_lunch'), location: t(portalTranslations, 'eventSchedule.day2.locations.vela_restaurant') },
            { time: "15:00 – 19:00", activity: t(portalTranslations, 'eventSchedule.day2.activities.artificial_intelligence'), location: t(portalTranslations, 'eventSchedule.day2.locations.blue_room') },
            { time: "20:00", activity: t(portalTranslations, 'eventSchedule.day2.activities.dinner_by_restaurant'), location: t(portalTranslations, 'eventSchedule.day2.locations.hotel_restaurants') }
        ]
    },

    day3: {
        ...buildDay('day3'),
        activities: [
            { time: "07:30 – 08:50", activity: t(portalTranslations, 'eventSchedule.day3.activities.breakfast'), location: t(portalTranslations, 'eventSchedule.day3.locations.hotel_restaurant') },
            { time: "09:00 – 10:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.welcome_networking'), location: t(portalTranslations, 'eventSchedule.day3.locations.blue_room') },
            { time: "10:00 – 14:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.effective_operating_budget'), location: t(portalTranslations, 'eventSchedule.day3.locations.blue_room') },
            { time: "14:00 – 15:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.buffet_lunch'), location: t(portalTranslations, 'eventSchedule.day3.locations.vela_restaurant') },
            { time: "15:00 – 16:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.suppliers_session'), location: t(portalTranslations, 'eventSchedule.day3.locations.blue_room') },
            { time: "16:00 – 18:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.best_practices'), location: t(portalTranslations, 'eventSchedule.day3.locations.blue_room') },
            { time: "18:00 – 18:20", activity: t(portalTranslations, 'eventSchedule.day3.activities.event_closing'), location: t(portalTranslations, 'eventSchedule.day3.locations.blue_room') },
            { time: "18:20 – 20:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.get_ready'), location: t(portalTranslations, 'eventSchedule.day3.locations.rooms') },
            { time: "20:00 – 00:00", activity: t(portalTranslations, 'eventSchedule.day3.activities.gala_dinner'), location: t(portalTranslations, 'eventSchedule.day3.locations.dinner_room') }
        ]
    },

    day4: {
        ...buildDay('day4'),
        activities: [
            {
                time: t(portalTranslations, 'eventSchedule.day4.activities.before_departure'),
                activity: t(portalTranslations, 'eventSchedule.day4.activities.checkout_luggage'),
                location: t(portalTranslations, 'eventSchedule.day4.locations.lobby')
            },
            ...['03:00', '05:30', '07:30', '09:00', '11:00'].map((time, i) => ({
                time,
                activity: t(portalTranslations, 'eventSchedule.day4.activities.departure_airport').replace(':number', String(i + 1)),
                location: t(portalTranslations, 'eventSchedule.day4.locations.lobby')
            }))
        ]
    }
};


function renderEventSchedule(day) {
    const container = document.getElementById('event-schedule-list');
    if (!container) return;

    const currentDay = eventSchedule[day];
    if (!currentDay) return;

    const labels = {
        schedule: t(portalTranslations, 'eventSchedule.schedule'),
        activity: t(portalTranslations, 'eventSchedule.activity'),
        location: t(portalTranslations, 'eventSchedule.location')
    };

    container.innerHTML = `
        <div class="schedule-day">
            <div class="schedule-day-header">
                <h3>${currentDay.title}</h3>
                <span>${currentDay.subtitle}</span>
            </div>

            <div class="event-table">
                <div class="event-header">
                    <div>${labels.schedule}</div>
                    <div>${labels.activity}</div>
                    <div>${labels.location}</div>
                </div>

                ${currentDay.activities.map(item => `
                    <div class="event-row">
                        <div class="event-time" data-label="${labels.schedule}">
                            ${item.time}
                        </div>

                        <div class="event-activity" data-label="${labels.activity}">
                            ${item.activity}
                        </div>

                        <div class="event-location" data-label="${labels.location}">
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
// FORMULARIO DE MENU
// ==============================
const SCRIPT_URL = "https://script.google.com/macros/s/AKfycbwpjlw7_zFmJ1i-4qrRb8ifn-bksVlCpM-6V7yRjvBZ6uoFQIsjK8W2KZjvaCAiZHCjDA/exec";

function initMenuForm() {
    const form = document.getElementById('menuForm');
    if (!form) return; // evita romper el script en páginas sin formulario

    const submitBtn = document.getElementById('submitBtn');
    const errorMsg = document.getElementById('errorMsg');
    const ticket = document.getElementById('ticket');
    const nameInput = document.getElementById('fullName');

    const submitText = submitBtn.dataset.defaultText;
    const savingText = submitBtn.dataset.savingText;
    const saveErrorText = errorMsg.dataset.saveError;

    function checkValid() {
        const name = nameInput.value.trim();
        const entrada = form.querySelector('input[name="entrada"]:checked');
        const plato = form.querySelector('input[name="platoFuerte"]:checked');
        const postre = form.querySelector('input[name="postre"]:checked');
        const valid = name.length > 2 && entrada && plato && postre;
        submitBtn.disabled = !valid;
        return valid;
    }

    form.addEventListener('input', () => {
        errorMsg.style.display = 'none';
        checkValid();
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!checkValid()) {
            errorMsg.style.display = 'block';
            return;
        }
        submitBtn.disabled = true;
        submitBtn.textContent = savingText;

        const name = nameInput.value.trim();
        const entrada = form.querySelector('input[name="entrada"]:checked').value;
        const plato = form.querySelector('input[name="platoFuerte"]:checked').value;
        const postre = form.querySelector('input[name="postre"]:checked').value;
        const allergyEl = document.getElementById('allergyNote');
        const allergy = allergyEl ? allergyEl.value.trim() : '';

        const record = {
            name,
            entrada,
            plato,
            postre,
            allergy,
            timestamp: new Date().toISOString()
        };

        try {
            const response = await fetch(SCRIPT_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'text/plain;charset=utf-8' },
                body: JSON.stringify(record)
            });

            // fetch no lanza error por códigos 4xx/5xx: hay que revisarlo a mano
            if (!response.ok) {
                throw new Error(`Respuesta no válida del servidor: ${response.status}`);
            }
        } catch (err) {
            console.error('Error guardando la selección', err);
            errorMsg.textContent = saveErrorText;
            errorMsg.style.display = 'block';
            submitBtn.disabled = false;
            submitBtn.textContent = submitText;
            return;
        }

        document.getElementById('t-name').textContent = name;
        document.getElementById('t-entrada').textContent = entrada;
        document.getElementById('t-plato').textContent = plato;
        document.getElementById('t-postre').textContent = postre;

        const allergyRow = document.getElementById('t-allergy-row');
        if (allergy) {
            document.getElementById('t-allergy').textContent = allergy;
            allergyRow.style.display = 'flex';
        } else {
            allergyRow.style.display = 'none';
        }

        form.style.display = 'none';
        ticket.classList.add('show');
        submitBtn.textContent = submitText;
    });

    const editLink = document.getElementById('editLink');
    if (editLink) {
        editLink.addEventListener('click', () => {
            ticket.classList.remove('show');
            form.style.display = 'block';
            checkValid();
        });
    }

    checkValid();
}

// ==============================
// CONTADOR
// ==============================

function initGalaCountdown() {
    const countdown = document.getElementById('galaCountdown');
    if (!countdown) return;

    const targetDate = new Date(countdown.dataset.target).getTime();

    const daysElement = document.getElementById('countdown-days');
    const hoursElement = document.getElementById('countdown-hours');
    const minutesElement = document.getElementById('countdown-minutes');
    const secondsElement = document.getElementById('countdown-seconds');

    function pad(value) {
        return String(value).padStart(2, '0');
    }

    let intervalId = null;

    function updateCountdown() {
        const now = Date.now();
        const difference = targetDate - now;

        if (difference <= 0) {
            daysElement.textContent = '00';
            hoursElement.textContent = '00';
            minutesElement.textContent = '00';
            secondsElement.textContent = '00';

            // Detener el intervalo: ya no tiene sentido seguir calculando cada segundo
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
            return;
        }

        const totalSeconds = Math.floor(difference / 1000);
        const days = Math.floor(totalSeconds / 86400);
        const hours = Math.floor((totalSeconds % 86400) / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;

        daysElement.textContent = pad(days);
        hoursElement.textContent = pad(hours);
        minutesElement.textContent = pad(minutes);
        secondsElement.textContent = pad(seconds);
    }

    updateCountdown();
    intervalId = setInterval(updateCountdown, 1000);
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

    initMenuForm();
    initGalaCountdown();
});