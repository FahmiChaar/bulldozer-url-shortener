import { aliases, md } from 'vuetify/iconsets/md'

const vuetifyCustomTheme = {
    colors: {
        primary: '#C18772',
        secondary: '#03DAC6',
        error: '#B00020',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FB8C00'
    }
}

const vuetifyConfig = {
    icons: {
        defaultSet: 'md',
        aliases,
        sets: {
            md,
        }
    },
    theme: {
        defaultTheme: 'vuetifyCustomTheme',
        themes: {
            vuetifyCustomTheme
        }
    }
}

export default vuetifyConfig