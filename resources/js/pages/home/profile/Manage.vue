<script>
export default {
    name: 'Manage Profile',
    components: {},
    title() {
        return this.$t('profile.manage_profile');
    },
    data() {
        return {
            profiles: []
        };
    },
    created() {
        console.log('Manage Profile');
        console.log(this.profiles.length)
    }
};
</script>

<template>
    <main id="select-profile">
        <h1 class="text-white fw-bold">{{ this.$t('profile.manage_profile') }}:</h1>
        <div class="container mx-md-5">
            <div id="profile-list" class="mt-3 row">
                <div class="card p-3 col-md-2 col-5">
                    <div class="image">
                        <i class='fa-light fa-pen edit-icon'></i>
                        <span class="mask opacity-5" style="background: #000;"></span>
                        <img class="card-img-top" src="https://picsum.photos/200/200" alt="Card image cap">
                    </div>
                    <div class="card-body p-2">
                        <p class="card-title text-center">Card title</p>
                    </div>
                </div>
            </div>
        </div>
        <router-link :to="{ name: 'select profile' }" id="done-profile" class="btn mt-md-5 mt-3">
            {{ this.$t('profile.done') }}
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

#done-profile {
    padding: 0.75rem 2.5rem;
    background: white;
    color: black;
    border-radius: 0;
    font-size: 1.2rem;

    &:hover {
        background: var(--nf-default-color);
        color: white;
    }
}

.card {
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    box-shadow: none;

    .image {
        position: relative;
        .edit-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            color: white;
            font-size: 2rem;
        }

        .card-img-top {
            border-radius: 0.25rem;
        }
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
