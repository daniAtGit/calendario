eventClassNames: function(arg) {
    return arg.event.extendedProps.icona ? ['evento-con-icona'] : [];
},
eventContent: function(arg) {
    if (!arg.event.extendedProps.icona) {
        return true;
    }

    var content = document.createElement('span');
    content.className = 'evento-contenuto';

    var icon = document.createElement('i');
    icon.className = arg.event.extendedProps.icona + ' fa-fw evento-icona';
    icon.style.color = arg.event.backgroundColor;
    icon.setAttribute('aria-hidden', 'true');

    var title = document.createElement('span');
    title.className = 'fc-event-title';
    title.textContent = arg.event.title;
    content.title = arg.event.extendedProps.iconaNome;
    content.append(icon, title);

    return { domNodes: [content] };
},
