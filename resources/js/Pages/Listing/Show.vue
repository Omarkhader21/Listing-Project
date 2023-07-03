<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="listing.images.length" class="md:col-span-7 flex items-center">
            <div class="grid grid-cols-2 gap-1">
                <img
                    v-for="image in listing.images" :key="image.id"
                    :src="image.src"
                />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center justify-center">No images</EmptyState>

        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%) </label>
                    <input type="range" min="0.1" max="30" step="0.1" v-model.number="interestRate"
                           class="w-full h-4 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

                    <label class="label">Duration ({{ duration }}) </label>
                    <input type="range" min="3" max="35" step="1" v-model.number="duration"
                           class="w-full h-4 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>
                </div>
                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">
                        Your Monthly Payment
                    </div>
                    <Price :price="monthlyPayment" class="text-3xl"></Price>
                </div>
                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>
                            Total Paid
                        </div>
                        <div>
                            <Price :price="totalPaid" class="font-medium"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            Principle Paid
                        </div>
                        <div>
                            <Price :price="listing.price" class="font-medium"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            Interest Paid
                        </div>
                        <div>
                            <Price :price="totalInterest" class="font-medium"/>
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer v-if="user" @offer-updated="offer = $event"
                :listing-id="listing.id" :price="listing.price">
            </MakeOffer>
            <OfferMade v-if="user && offerMade" :offer="offerMade">

            </OfferMade>
        </div>
    </div>
</template>
<script setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import EmptyState from "@/Components/UI/Box.vue";
import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
import {useMonthlyPayment} from "@/Composables/useMonthlyPayment.js";
import {computed, ref} from 'vue';
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import OfferMade from "@/Pages/Listing/Show/Components/OfferMade.vue";

const interestRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
    offerMade: Object
});

const page = usePage();

const user = computed(
    () => page.props.value.user,
)

const form = useForm({
    amount:props.amount
})

const offer = ref(props.listing.price)

const {monthlyPayment, totalPaid, totalInterest} = useMonthlyPayment(offer, interestRate, duration);

</script>
