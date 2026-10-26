import test from 'node:test';
import assert from 'node:assert/strict';
import iconPicker, { iconCatalog } from '../../resources/js/icon-picker.js';

test('ricerca italiana, inglese e senza accenti; filtro per categoria', () => {
    const picker = iconPicker();
    picker.query = 'medico';
    assert.ok(picker.filtered.some((icon) => icon.classe === 'fa-solid fa-stethoscope'));
    picker.query = 'attivita';
    assert.ok(picker.filtered.some((icon) => icon.label === 'Attività'));
    picker.query = 'phone';
    assert.ok(picker.filtered.some((icon) => icon.label === 'Telefono'));
    picker.category = 'Salute';
    assert.equal(picker.filtered.length, 0);
    picker.query = '';
    assert.ok(picker.filtered.length > 0);
    assert.ok(picker.filtered.every((icon) => icon.category === 'Salute'));
    picker.query = 'inesistente123';
    assert.equal(picker.filtered.length, 0);
});

test('selezione propone il nome e conserva il nome personalizzato', () => {
    const picker = iconPicker('fa-solid fa-calendar');
    const phone = iconCatalog.find((icon) => icon.label === 'Telefono');
    const car = iconCatalog.find((icon) => icon.label === 'Auto');
    picker.choose(phone);
    assert.equal(picker.classe, 'fa-solid fa-phone');
    assert.equal(picker.nome, 'Telefono');
    picker.choose(car);
    assert.equal(picker.nome, 'Auto');
    picker.nome = 'Tagliando di Mario';
    picker.choose(phone);
    assert.equal(picker.nome, 'Tagliando di Mario');
    assert.equal(picker.selectedLabel, 'Telefono');
});

test('icone personalizzate esistenti e ricerca non alterano la selezione', () => {
    const picker = iconPicker('fa-regular fa-snowflake', 'Controllo clima');
    assert.equal(picker.selectedLabel, 'fa-regular fa-snowflake');
    picker.query = 'telefono';
    assert.equal(picker.classe, 'fa-regular fa-snowflake');
    assert.equal(picker.nome, 'Controllo clima');
    picker.choose(picker.filtered[0]);
    assert.equal(picker.nome, 'Controllo clima');
});

test('catalogo senza duplicati e risultati progressivi', () => {
    assert.equal(new Set(iconCatalog.map((icon) => icon.classe)).size, iconCatalog.length);
    assert.ok(iconCatalog.length > 96);
    const picker = iconPicker();
    assert.equal(picker.visible.length, 48);
    picker.limit += 48;
    assert.equal(picker.visible.length, 96);
    picker.limit += 48;
    assert.equal(picker.visible.length, iconCatalog.length);
});
