<template>
    <div class="form-check">
        <input
            :id="id"
            class="form-check-input"
            type="checkbox"
            :name="name"
            :checked="checked"
        />
        <label :for="id" class="custom-control-label fw-normal ms-0 " :class="$attrs.class">
            <slot/>
        </label>
    </div>
</template>

<script>
export default {
    name: "ArgonCheckbox",
    props: {
        name: {
            type: String,
            default: "",
        },
        id: {
            type: String,
            default: "",
        },
        checked: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
<style scoped>
.form-check-input{
    background-image: unset !important;
    background: rgb(118, 118, 118);
}

.form-check-input:hover {
    background: white;
}

.form-check-input:after {
    color: black !important;
}

label {
    color: #b3b3b3;
}
</style>
