import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const source = readFileSync(new URL('../../resources/views/partials/calendar-event-options.blade.php', import.meta.url), 'utf8');
const document = {
    createElement(tag) {
        return {
            tag, style: {}, attrs: {}, children: [],
            setAttribute(name, value) { this.attrs[name] = value; },
            append(...children) { this.children.push(...children); },
        };
    },
};
const options = new Function('document', `return ({${source}});`)(document);

test('senza icona mantiene contenuto e pallino predefiniti di FullCalendar', () => {
    for (const icona of [null, undefined, '']) {
        const arg = { event: { extendedProps: { icona } } };
        assert.equal(options.eventContent(arg), true);
        assert.deepEqual(options.eventClassNames(arg), []);
    }
});

test('con icona applica il colore della persona e la classe che nasconde il pallino', () => {
    const arg = {
        event: {
            title: 'Visita', backgroundColor: '#ff0000',
            extendedProps: { icona: 'fa-solid fa-stethoscope', iconaNome: 'Medico' },
        },
    };
    assert.deepEqual(options.eventClassNames(arg), ['evento-con-icona']);
    const content = options.eventContent(arg).domNodes[0];
    assert.equal(content.children[0].className, 'fa-solid fa-stethoscope fa-fw evento-icona');
    assert.equal(content.children[0].style.color, '#ff0000');
    assert.equal(content.children[1].textContent, 'Visita');
    assert.equal(content.title, 'Medico');
});
