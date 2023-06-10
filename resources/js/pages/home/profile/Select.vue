<script>
export default {
    name: 'Select Profile',
    components: {},
    data() {
        return {
            profiles: []
        };
    },
    created() {
        console.log('Select Profile');
        console.log(this.profiles.length)
    }
};
</script>

<template>
    <main id="select-profile">
        <h1 class="text-white fw-bold">{{ this.$t('profile.who_watching') }}</h1>
        <div class="container mx-md-5">
            <div id="profile-list" class="mt-3 row">
                <div class="card p-3 col-md-2 col-5">
                    <img class="card-img-top" src="https://picsum.photos/200/200" alt="Card image cap">
                    <div class="card-body p-2">
                        <p class="card-title text-center">Card title</p>
                    </div>
                </div>
                <div class="card p-3 col-md-2 col-5" v-if="profiles.length < 5">
                    <img class="card-img-top" src="../../../assets/img/avatar/add-profile.png" alt="Card image cap">
                    <div class="card-body p-2">
                        <p class="card-title text-center">{{ this.$t('profile.add_profile') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <router-link :to="{ name: 'login' }" id="manage-profile" class="btn mt-md-5 mt-3">
            {{ this.$t('profile.manage_profile') }}
        </router-link>
    </main>
</template>

<style scoped>
#select-profile {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#profile-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

#manage-profile {
    padding: 0.75rem 2.5rem;
    background: transparent;
    color: white;
    border: 1px solid white;
    border-radius: 0;
    font-size: 1rem;
    opacity: 0.5;

    &:hover {
        opacity: 1;
    }
}

.card {
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    box-shadow: none;

    .card-img-top {
        border-radius: 0.25rem;
    }

    .card-body {
        .card-title {
            font-size: 1.5rem;
            color: white;
            opacity: 0.5;
        }
    }

    &:hover {
        .card-img-top {
            border: 3px solid white;
        }

        .card-body {
            .card-title {
                opacity: 1;
            }
        }
    }
}

@media (min-width: 768px) {
    .card-body {
        .card-title {
            font-size: 1rem;
        }
    }

    &:hover {
        .card-img-top {
            border: 2px solid white;
        }
    }
}

</style>
