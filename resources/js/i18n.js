import { createI18n } from 'vue-i18n'

export let i18n = null

export default function setupI18n(locale, translations) {
    i18n = createI18n({
        legacy: false,
        globalInjection: true,
        locale,
        fallbackLocale: 'en',
        messages: {
            [locale]: translations
        }
    })

    return i18n
}
