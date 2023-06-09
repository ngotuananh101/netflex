<script>
export default {
    name: "AuthFooter",
    components: {},
    data() {
        return {
            footer: [1, 2, 8, 9, 10, 11],
            language: 'en',
        }
    },
    created() {
        this.language = this.$root.language;
    },
    methods: {
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        }
    },
}
</script>

<template>
    <footer class="w-100 mt-md-5" style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="container my-5 position-relative" style="z-index: 3;">
            <div class="row opacity-6">
                <div class="col-12 mb-3">
                    <a :href="$t('landing.footers.0.link')" class="fs-6 text-white">{{
                            $t('landing.footers.0.title')
                        }}</a>
                </div>
                <div class="col-md-3 col-6 mt-2" v-for="value in footer">
                    <a :href="$t('landing.footers.' + value + '.link')"
                       class="text-light text-sm">{{ $t('landing.footers.' + value + '.title') }}</a>
                </div>
                <div class="col-12 mb-3"></div>
                <div class="col-md-2 col-6 mt-2 d-flex flex-column">
                    <select
                        id="choices-language"
                        class="form-control px-4 fs-6 text-white"
                        name="choices-language"
                        style="max-height: 100%;"
                        @change="changeLanguage"
                        v-model="language"
                    >
                        <option value="vi" data-select-text="Tiếng Việt">Tiếng Việt</option>
                        <option value="en" data-select-text="English">English</option>
                    </select>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>

</style>
