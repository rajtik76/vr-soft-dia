<script lang="ts" setup>
import {Link, router, useForm} from "@inertiajs/vue3";
import {MedicineResource} from "@/types/resource";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps<{
    medicine: MedicineResource
}>()

const form = useForm({
    name: props.medicine.name ?? '',
})

const submit = () => {
    if (props.medicine.id > 0) {
        // update medicine
        form.patch(route(`medicine.update`, {medicine: props.medicine.id}))
    } else {
        // create new medicine
        form.post(route('medicine.store'))
    }
}
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="name" :value="$t('base.name')" />

            <TextInput
                id="name"
                type="name"
                class="mt-1 block w-full p-2"
                v-model="form.name"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <PrimaryButton :class="{ 'opacity-25': form.processing }"
                           @click.prevent="router.get(route('medicine.index'))">
                {{ $t('base.back') }}
            </PrimaryButton>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('base.submit') }}
            </PrimaryButton>
        </div>
    </form>
</template>
