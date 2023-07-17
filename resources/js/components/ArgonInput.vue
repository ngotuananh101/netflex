<template>
    <div class="form-group">
        <div :class="hasIcon(icon)">
            <span v-if="iconDir === 'left'" class="input-group-text">
                <i :class="getIcon(icon)"></i>
            </span>
            <input
                :id="id"
                :type="type" class="form-control"
                :class="getClasses(size, success, error)"
                :name="name"
                :value="value"
                :placeholder="placeholder"
                :required="isRequired"
                @change="inputChange"/>
            <span v-if="iconDir === 'right'" class="input-group-text">
                <i :class="getIcon(icon)"></i>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArgonInput",
    props: {
        size: {
            type: String,
            default: "default",
        },
        success: {
            type: Boolean,
            default: false,
        },
        error: {
            type: Boolean,
            default: false,
        },
        icon: {
            type: String,
            default: "",
        },
        iconDir: {
            type: String,
            default: "",
        },
        name: {
            type: String,
            default: "",
        },
        id: {
            type: String,
            default: "",
        },
        value: {
            type: String,
            default: "",
        },
        placeholder: {
            type: String,
            default: "",
        },
        type: {
            type: String,
            default: "text",
        },
        isRequired: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        getClasses: (size, success, error) => {
            let sizeValue, isValidValue;
            sizeValue = size ? `form-control-${size}` : null;
            if (error) {
                isValidValue = "is-invalid";
            } else if (success) {
                isValidValue = "is-valid";
            } else {
                isValidValue = "";
            }
            return `${sizeValue} ${isValidValue}`;
        },
        getIcon: (icon) => (icon ? icon : null),
        hasIcon: (icon) => (icon ? "input-group" : null),
        inputChange(event) {
            if (this.isRequired) {
                // remove is-invalid or is-valid class
                event.target.classList.remove('is-invalid');
                event.target.classList.remove('is-valid');
                if (this.type === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    // check if email is valid
                    if (!emailRegex.test(event.target.value)) {
                        event.target.classList.add('is-invalid');
                    }else{
                        event.target.classList.add('is-valid');
                    }
                } else if (this.type === 'password') {
                    // check if password is valid
                    if (event.target.value.length < 6) {
                        event.target.classList.add('is-invalid');
                    }else{
                        event.target.classList.add('is-valid');
                    }
                } else {
                    // check if input is empty
                    if (event.target.value === '') {
                        // add success class
                        event.target.classList.add('is-invalid');
                    }else{
                        event.target.classList.add('is-valid');
                    }
                }
            }
        },
    },
};
</script>

<style scoped>
input {
    background: #333;
    padding: 1rem;
    font-size: 1.1rem;
    border: 0;
    color: #fff;
}

input:focus {
    background: #404040;
    color: #fff;
    border: 0;
}
.is-invalid {
    border: 0;
    border-bottom: 0.18rem solid #e87c03 !important;
    background-size: 1.3rem 1.3rem !important;
}
</style>
