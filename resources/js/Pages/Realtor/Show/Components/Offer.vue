<template>
    <Box>
        <template #header>Offer #{{ offer.id }} <span v-if="offer.accepted_at" class="dark:bg-green-900 dark:text-green-200 text-green-900 p-1 rounded-md uppercase ml-2">Accepted</span></template>
        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl"></Price>
                <div class="text-gray-500">
                    Difference
                    <Price :price="difference"></Price>
                </div>
                <div class="text-gray-500 text-sm">
                    Made By {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500 text-sm">
                    Made on: {{ madeOn }}
                </div>
            </div>
            <div>
                <Link v-if="!isSold" :href="route('realtor.offer.accept',{offer: offer.id})" class="btn-outline text-xs font-medium" method="put"
                      as="button">Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import {Link} from '@inertiajs/inertia-vue3'
import {computed} from "vue";

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
})

const difference = computed(
    () => props.offer.amount - props.listingPrice,
)

const madeOn = computed(
    () => new Date(props.offer.created_at).toDateString()
)

// const notSold = computed(
//     () => !props.offer.accepted_at && !props.offer.rejected_at,
// )
</script>

