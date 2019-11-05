<template>
    <div class="root">
        <span id="typed"></span>
    </div>
</template>

<script>
    export default {
        name: "kaan-karaoglu",
        mounted() {
            new Typed('#typed', {
                strings: [
                    'Welcome!<br>',
                    'Välkommen!<br>' +
                    'I\'m Kaan Karaoglu.<br>^1000' +
                    'Say hello at <a style="color: #1ed760; text-decoration: none;" href="mailto:kaankaraoglu@outlook.com"</a>kaankaraoglu@outlook.com<br>' +
                    '<a href="https://kaankaraoglu.com/content/resume.pdf" target="_blank" style="color: #1ed760; text-decoration: none;">Résumé.</a><br>' +
                    '<a href="https://github.com/kaankaraoglu" target="_blank" style="color: #1ed760; text-decoration: none;">Github.</a><br>' +
                    '<a href="https://se.linkedin.com/in/kaan-karaoglu" target="_blank" style="color: #1ed760; text-decoration: none;">LinkedIn.</a><br>' +
                    'Knock yourself out!<br>'
                ],
                typeSpeed: 30,
                backSpeed: 50,
                loop: false
            });
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .root {
        text-align: left;
    }
</style>
