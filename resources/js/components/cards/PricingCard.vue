<template>
    <div class="card">
        <div class="pt-4 pb-3 text-center card-header bg-transparent">
            <span class="badge text-uppercase font-weight-bold text-dark">{{ badge }}</span>
            <h3 class="currency mt-2 font-weight-bold">
                <small>{{ price.currency }}</small
                >{{ price.value }}
            </h3>
        </div>
        <div class="pt-0 text-center card-body text-lg-start">
            <div
                v-for="({ label, includes }, index) of specifications"
                :key="index"
                class="p-2 d-flex justify-content-lg-start justify-content-center"
            >
                <div
                    class="text-center shadow icon icon-shape icon-xs rounded-circle"
                    :class="includes ? 'bg-gradient-success' : 'bg-gradient-danger'"
                >
                    <i
                        :class="`fas ${includes ? 'fa-check' : 'fa-minus'} opacity-10`"
                    ></i>
                </div>
                <div>
                    <span class="ps-3">{{ label }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PricingCard",
    props: {
        badge: {
            type: String,
            required: true,
        },
        price: {
            type: Object,
            required: true,
            currency: String,
            value: String,
        },
        specifications: {
            type: Array,
            required: true,
            label: String,
            includes: Boolean,
        },
    },
};
</script>
<style>
.card.active {
    .badge {
        color: white !important;
    }

    .currency {
        color: white;
    }
}
</style>
