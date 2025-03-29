import { describe, it, expect, vi, beforeEach } from 'vitest'
import { mount } from '@vue/test-utils'
import ContactForm from '../ContactForm.vue'

// Mock Inertia router
vi.mock('@inertiajs/vue3', () => ({
    router: {
        post: vi.fn(),
    },
}))

// Mock i18n
vi.mock('vue-i18n', () => ({
    useI18n: () => ({
        t: (key: string) => key,
        $t: (key: string) => key
    })
}))

describe('ContactForm', () => {
    let wrapper: any

    beforeEach(() => {
        wrapper = mount(ContactForm, {
            global: {
                stubs: {
                    'Transition': false
                },
                mocks: {
                    $t: (key: string) => key
                }
            }
        })
        // Expand the form
        wrapper.vm.isExpanded = true
    })

    it('renders properly', () => {
        expect(wrapper.exists()).toBe(true)
        expect(wrapper.find('form').exists()).toBe(true)
        expect(wrapper.find('input[type="text"]').exists()).toBe(true)
        expect(wrapper.find('input[type="tel"]').exists()).toBe(true)
    })

    it('submits form data when submitted', async () => {
        const formData = {
            name: 'John Doe',
            phone_number: '1234567890'
        }

        await wrapper.find('input[type="text"]').setValue(formData.name)
        await wrapper.find('input[type="tel"]').setValue(formData.phone_number)
        await wrapper.find('form').trigger('submit.prevent')

        const router = (await import('@inertiajs/vue3')).router
        expect(router.post).toHaveBeenCalledWith('/contacts', formData, expect.any(Object))
    })

    it('shows validation errors when submitting empty form', async () => {
        await wrapper.find('form').trigger('submit.prevent')
        await wrapper.vm.$nextTick()

        // Set validation errors manually since we're mocking the router
        wrapper.vm.errors = {
            name: 'Name is required',
            phone_number: 'Phone number is required'
        }
        await wrapper.vm.$nextTick()

        const errorMessages = wrapper.findAll('.text-red-500')
        expect(errorMessages.length).toBe(2)
    })

    it('toggles form visibility when button is clicked', async () => {
        expect(wrapper.vm.isExpanded).toBe(true)
        await wrapper.find('button').trigger('click')
        expect(wrapper.vm.isExpanded).toBe(false)
    })
}) 