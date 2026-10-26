// Simboli comuni del set Classic di FontAwesome, caricati dal kit già presente nel sito.
const groups = {
    'Appuntamenti': [
        ['calendar', 'Calendario', 'giorno data appuntamento'],
        ['calendar-check', 'Appuntamento confermato', 'prenotazione conferma'],
        ['calendar-plus', 'Nuovo appuntamento', 'aggiungi prenotazione'],
        ['calendar-times', 'Appuntamento annullato', 'cancella disdetta'],
        ['clock', 'Orologio', 'ora tempo scadenza'],
        ['bell', 'Promemoria', 'avviso notifica sveglia'],
        ['check-circle', 'Completato', 'fatto confermato'],
        ['exclamation-triangle', 'Attenzione', 'urgente avviso importante'],
        ['hourglass-half', 'In attesa', 'tempo attesa'],
        ['sync-alt', 'Ricorrenza', 'ripeti periodico'],
    ],
    'Comunicazione': [
        ['phone', 'Telefono', 'chiamata telefonata contatto'],
        ['mobile-alt', 'Cellulare', 'telefono smartphone'],
        ['envelope', 'Email', 'posta messaggio lettera'],
        ['comment', 'Messaggio', 'chat comunicazione'],
        ['comments', 'Conversazione', 'chat colloquio incontro'],
        ['video', 'Videochiamata', 'riunione online videoconferenza'],
        ['headset', 'Assistenza', 'supporto chiamata'],
        ['bullhorn', 'Annuncio', 'comunicazione avviso'],
        ['paper-plane', 'Invio', 'messaggio spedizione'],
    ],
    'Persone e lavoro': [
        ['user', 'Persona', 'contatto individuale'],
        ['users', 'Gruppo', 'persone riunione famiglia'],
        ['user-friends', 'Incontro', 'amici persone'],
        ['handshake', 'Accordo', 'incontro contratto cliente'],
        ['briefcase', 'Lavoro', 'ufficio professione'],
        ['building', 'Ufficio', 'azienda lavoro sede'],
        ['laptop', 'Computer', 'lavoro portatile informatica'],
        ['tasks', 'Attività', 'lavoro lista compiti'],
        ['clipboard', 'Appunti', 'note elenco'],
        ['file-alt', 'Documento', 'pratica testo carta'],
        ['folder', 'Cartella', 'documenti archivio pratica'],
        ['pen', 'Firma', 'scrivere documento'],
        ['print', 'Stampa', 'stampante documento'],
        ['tools', 'Manutenzione', 'riparazione lavoro tecnico'],
        ['wrench', 'Riparazione', 'tecnico manutenzione'],
    ],
    'Salute': [
        ['stethoscope', 'Visita medica', 'medico dottore controllo salute'],
        ['user-md', 'Medico', 'dottore specialista visita'],
        ['hospital', 'Ospedale', 'clinica salute ricovero'],
        ['heartbeat', 'Controllo cardiologico', 'cuore salute visita'],
        ['heart', 'Cuore', 'salute benessere amore'],
        ['tooth', 'Dentista', 'denti visita odontoiatra'],
        ['eye', 'Oculista', 'occhio vista controllo'],
        ['pills', 'Farmaci', 'medicina pillole farmacia'],
        ['syringe', 'Vaccino', 'puntura iniezione prelievo'],
        ['band-aid', 'Medicazione', 'cerotto cura salute'],
        ['ambulance', 'Ambulanza', 'emergenza soccorso'],
        ['wheelchair', 'Accessibilità', 'assistenza disabilità'],
        ['spa', 'Benessere', 'relax trattamento'],
    ],
    'Casa e famiglia': [
        ['home', 'Casa', 'abitazione domicilio famiglia'],
        ['key', 'Chiavi', 'casa consegna accesso'],
        ['baby', 'Bambino', 'neonato famiglia pediatra'],
        ['child', 'Figlio', 'bambino famiglia'],
        ['paw', 'Animali', 'cane gatto veterinario'],
        ['birthday-cake', 'Compleanno', 'torta festa anniversario'],
        ['gift', 'Regalo', 'festa compleanno'],
        ['utensils', 'Pranzo o cena', 'ristorante mangiare pasto'],
        ['coffee', 'Caffè', 'bar colazione pausa'],
        ['shopping-cart', 'Spesa', 'supermercato acquisti'],
        ['shopping-bag', 'Acquisti', 'negozio shopping'],
        ['couch', 'Arredamento', 'casa mobili divano'],
        ['broom', 'Pulizie', 'casa domestico'],
    ],
    'Viaggi e luoghi': [
        ['car', 'Auto', 'macchina viaggio officina'],
        ['taxi', 'Taxi', 'auto trasporto'],
        ['bus', 'Autobus', 'trasporto viaggio'],
        ['train', 'Treno', 'stazione viaggio'],
        ['plane', 'Aereo', 'volo aeroporto viaggio'],
        ['bicycle', 'Bicicletta', 'bici sport trasporto'],
        ['walking', 'Passeggiata', 'camminare escursione'],
        ['map-marker-alt', 'Luogo', 'indirizzo posizione destinazione'],
        ['map', 'Mappa', 'viaggio percorso'],
        ['suitcase', 'Valigia', 'vacanza viaggio partenza'],
        ['hotel', 'Hotel', 'albergo soggiorno vacanza'],
        ['umbrella-beach', 'Vacanza', 'mare spiaggia ferie'],
        ['gas-pump', 'Rifornimento', 'benzina auto'],
    ],
    'Sport e tempo libero': [
        ['dumbbell', 'Palestra', 'sport allenamento fitness'],
        ['running', 'Corsa', 'sport allenamento'],
        ['swimmer', 'Nuoto', 'piscina sport'],
        ['futbol', 'Calcio', 'partita pallone sport'],
        ['basketball-ball', 'Basket', 'pallacanestro partita sport'],
        ['music', 'Musica', 'lezione concerto strumento'],
        ['film', 'Cinema', 'film spettacolo'],
        ['theater-masks', 'Teatro', 'spettacolo recita'],
        ['book', 'Libro', 'lettura studio biblioteca'],
        ['graduation-cap', 'Scuola', 'lezione studio corso università'],
        ['palette', 'Arte', 'disegno pittura corso'],
        ['camera', 'Fotografia', 'foto servizio'],
        ['gamepad', 'Giochi', 'videogiochi tempo libero'],
        ['star', 'Preferito', 'speciale importante'],
    ],
    'Pagamenti e servizi': [
        ['euro-sign', 'Pagamento', 'soldi scadenza euro'],
        ['credit-card', 'Carta di credito', 'pagamento banca'],
        ['money-bill', 'Contanti', 'soldi pagamento'],
        ['university', 'Banca', 'sportello ufficio pubblico'],
        ['file-invoice', 'Fattura', 'documento pagamento bolletta'],
        ['receipt', 'Ricevuta', 'scontrino pagamento'],
        ['truck', 'Consegna', 'corriere spedizione trasporto'],
        ['box', 'Pacco', 'consegna ritiro spedizione'],
        ['cut', 'Parrucchiere', 'capelli taglio barbiere'],
        ['tshirt', 'Abbigliamento', 'vestiti lavanderia'],
        ['gavel', 'Pratica legale', 'avvocato tribunale'],
        ['lightbulb', 'Idea', 'luce energia'],
    ],
};

export const iconCatalog = Object.entries(groups).flatMap(([category, icons]) =>
    icons.map(([icon, label, keywords]) => ({
        classe: `fa-solid fa-${icon}`,
        label,
        category,
        search: `${label} ${keywords} ${icon}`,
    })),
);

const normalize = (value) => value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();

export default function iconPicker(initialClass = '', initialName = '') {
    return {
        classe: initialClass,
        nome: initialName,
        query: '',
        category: '',
        limit: 48,
        catalog: iconCatalog,
        categories: Object.keys(groups),
        get filtered() {
            const terms = normalize(this.query).split(/\s+/).filter(Boolean);
            return this.catalog.filter((icon) =>
                (!this.category || icon.category === this.category) &&
                terms.every((term) => normalize(icon.search).includes(term)),
            );
        },
        get visible() {
            return this.filtered.slice(0, this.limit);
        },
        get selectedLabel() {
            return this.catalog.find((icon) => icon.classe === this.classe)?.label || this.classe;
        },
        choose(icon) {
            const previousLabel = this.selectedLabel;
            if (!this.nome.trim() || this.nome === previousLabel) {
                this.nome = icon.label;
            }
            this.classe = icon.classe;
        },
    };
}
