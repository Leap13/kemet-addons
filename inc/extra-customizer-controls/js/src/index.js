import Templates from './components/Templates'
const { kmtEvents } = window.KmtOptionComponent;

kmtEvents.on('kmt:options', function ({ detail: options }) {
    options['kmt-templates'] = Templates;
})
