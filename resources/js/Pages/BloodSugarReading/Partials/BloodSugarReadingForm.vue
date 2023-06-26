<script lang="ts" setup>
import {router, useForm} from "@inertiajs/vue3";
import {BloodSugarReading} from "@/types/resource";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NumberInput from "@/Components/NumberInput.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps<{
    reading: BloodSugarReading
}>()

const form = useForm({
    date: props.reading.date,
    before_breakfast: props.reading.before_breakfast,
    after_breakfast: props.reading.after_breakfast,
    before_lunch: props.reading.before_lunch,
    after_lunch: props.reading.after_lunch,
    before_dinner: props.reading.before_dinner,
    after_dinner: props.reading.after_dinner,
    note: props.reading.note,
})

const submit = () => {
    if (props.reading.id > 0) {
        // update reading
        form.patch(route(`bloodSugarReading.update`, {bloodSugarReading: props.reading.id}))
    } else {
        // create new reading
        form.post(route('bloodSugarReading.store'))
    }
}
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel :value="$t('blood_sugar_reading.date')" for="date"/>

            <TextInput
                id="date"
                v-model="form.date"
                autofocus
                class="mt-1 block w-fit p-2"
                required
                type="date"
            />

            <InputError :message="form.errors.date" class="mt-2"/>
        </div>

        <div class="mt-4 flex gap-2 flex-col lg:flex-row justify-between">
            <div class="reading-border">
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.before_breakfast')" for="before_breakfast"/>

                    <NumberInput
                        id="before_breakfast"
                        v-model="form.before_breakfast"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.before_breakfast" class="mt-2"/>
                </div>
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.after_breakfast')" for="after_breakfast"/>

                    <NumberInput
                        id="after_breakfast"
                        v-model="form.after_breakfast"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.after_breakfast" class="mt-2"/>
                </div>
            </div>

            <div class="reading-border">
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.before_lunch')" for="before_lunch"/>

                    <NumberInput
                        id="before_lunch"
                        v-model="form.before_lunch"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.before_lunch" class="mt-2"/>
                </div>
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.after_lunch')" for="after_lunch"/>

                    <NumberInput
                        id="after_lunch"
                        v-model="form.after_lunch"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.after_lunch" class="mt-2"/>
                </div>
            </div>

            <div class="reading-border">
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.before_dinner')" for="before_dinner"/>

                    <NumberInput
                        id="before_dinner"
                        v-model="form.before_dinner"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.before_dinner" class="mt-2"/>
                </div>
                <div>
                    <InputLabel :value="$t('blood_sugar_reading.after_dinner')" for="after_dinner"/>

                    <NumberInput
                        id="after_dinner"
                        v-model="form.after_dinner"
                        class="reading"
                        step="0.1"
                    />

                    <InputError :message="form.errors.after_dinner" class="mt-2"/>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('base.submit') }}
            </PrimaryButton>
            <PrimaryButton :class="{ 'opacity-25': form.processing }"
                           @click.prevent="router.get(route('bloodSugarReading.index'))">
                {{ $t('base.back') }}
            </PrimaryButton>
        </div>
    </form>
</template>

<style lang="postcss" scoped>
.reading {
    @apply mt-1 block w-32
}

.reading-border {
    @apply flex gap-1 lg:border dark:border-gray-600 rounded-lg p-4
}
</style>
