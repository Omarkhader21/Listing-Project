<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div  class="col-span-2">
                <label class="label">Beds</label>
                <input type="text" v-model="form.beds" class="input"/>
                <div v-if="form.errors.beds" class="input-error">
                    {{form.errors.beds}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input type="text" v-model="form.baths" class="input"/>
                <div v-if="form.errors.baths" class="input-error">
                    {{form.errors.baths}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input type="text" v-model="form.area" class="input"/>
                <div v-if="form.errors.area" class="input-error">
                    {{form.errors.area}}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input type="text" v-model="form.city" class="input"/>
                <div v-if="form.errors.city" class="input-error">
                    {{form.errors.city}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input type="text" v-model="form.code" class="input"/>
                <div v-if="form.errors.code" class="input-error">
                    {{form.errors.code}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street</label>
                <input type="text" v-model="form.street" class="input"/>
                <div v-if="form.errors.street" class="input-error">
                    {{form.errors.street}}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street Nr</label>
                <input type="text" v-model="form.street_nr" class="input"/>
                <div v-if="form.errors.street_nr" class="input-error">
                    {{form.errors.street_nr}}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input type="text" v-model="form.price" class="input"/>
                <div v-if="form.errors.price" class="input-error">
                    {{form.errors.price}}
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" class="text-lg font-medium bg-indigo-600 hover:bg-indigo-500 text-white p-2 rounded-md">Update</button>
            </div>
        </div>
    </form>
</template>

<script setup>
// eslint-disable-next-line no-unused-vars
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    listing: Object,
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});




const update = () => form.put(route('realtor.listing.update',{listing: props.listing.id}));

</script>


<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>
