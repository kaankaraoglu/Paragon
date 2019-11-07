<template>
    <stat-card
        :card-data="cardData"
        :card-title="cardTitle"
        :card-text="cardText">
    </stat-card>
</template>

<script>
    import StatCard from './StatCard'
    export default {
        name: 'TopArtistsStatCard',
        components: {
            StatCard
        },

        computed: {
            cardData() {

            },

            cardTitle() {

            },

            cardText() {

            },
        },

        data() {
            return {
                response: []
            }
        },

        mounted() {
            this._getUsersTopArtists();
        },

        methods: {
            _getUsersTopArtists(){
                const that = this;
                let endpoint = 'get-user-top-artists';

                axios.post(endpoint)
                    .then((response) => {
                        this.response = response.data['items'];
                    })
                    .catch(function (error) {
                       console.log(error);
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
