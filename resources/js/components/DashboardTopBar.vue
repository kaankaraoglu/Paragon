<template>
    <div class="row header">
        <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="true">Stats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Generate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="false">Public Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
            </li>
        </ul>
        <div class="profile">
            <img class="avatar" :src="avatar" alt="avatar">
            <a :href="profileLink" target="_blank" class="username info-link">{{ userId }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'dashboard-top-bar',
        props: {
            avatar: String,
            profileLink: String,
            userId: String
        },
        mounted() {
            console.log(this.avatar);
        }
    }
</script>
