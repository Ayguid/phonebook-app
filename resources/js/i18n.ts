import { createI18n } from 'vue-i18n';
import en from './lang/en.json';
import es from './lang/es.json';

export const i18n = createI18n({
    legacy: false,
    locale: 'en',
    messages: {
        en,
        es
    }
}); 