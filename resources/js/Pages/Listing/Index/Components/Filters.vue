<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.priceFrom" type="text" class="filter-input-r w-28" placeholder="price from">
                <input v-model.number="filterForm.priceTo" type="text" class="filter-input-l w-28" placeholder="price to">
            </div>
            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.beds" class="filter-input-r w-28">
                    <option :value="null">beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>+6</option>
                </select>
                <select v-model="filterForm.baths" class="filter-input-l w-28">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>+6</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.areaFrom" type="text" class="filter-input-r w-28" placeholder="Area from">
                <input v-model.number="filterForm.areaTo" type="text" class="filter-input-l w-28" placeholder="Area to">
            </div>

            <button type="submit" class="button-primary">Filter</button>
            <button type="reset" @click="clear">Rest</button>
        </div>
    </form>
</template>

<script setup>
    import {useForm} from "@inertiajs/inertia-vue3";

    const props = defineProps({filters:Object})

    const filterForm = useForm({
        priceFrom: props.filters.priceFrom ?? null,
        priceTo: props.filters.priceTo ?? null,
        beds: props.filters.beds ?? null,
        baths: props.filters.baths ?? null,
        areaFrom: props.filters.areaFrom ?? null,
        areaTo: props.filters.areaTo ?? null,
    });

    const filter = () => {
        filterForm.get(
            route('listing.index'),
            {
                preserveState: true,
                preserveScroll: true,
            }
        )
    }

    const clear = () => {
        filterForm.priceFrom = null;
        filterForm.priceTo = null;
        filterForm.beds = null;
        filterForm.baths = null;
        filterForm.areaFrom = null;
        filterForm.areaTo = null;
        filter();
    }
</script>

