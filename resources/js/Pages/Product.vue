<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
  <Head title="Products" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Products
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="container flex justify-center mx-auto">
            <div class="flex flex-col">
              <div class="w-full">
                <form @submit.prevent="submit">
                  <div class="flex flex-wrap mb-6">
                    <div class="mt-4">
                      <BreezeLabel for="name" value="Name" />
                      <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="name"/>
                    </div>
                    <div class="mt-4">
                      <BreezeLabel for="authorName" value="Author Name" />
                      <BreezeInput id="authorName" type="text" class="mt-1 block w-full" v-model="authorName"/>
                    </div>
                    <div class="mt-4">
                      <BreezeLabel for="createdAt" value="Created At" />
                      <BreezeInput id="createdAt" type="date" class="mt-1 block w-full" v-model="createdAt"/>
                    </div>
                    <div class="mt-4">
<!--                      <BreezeLabel />-->
                      <BreezeButton class="mt-6 ml-6">
                        Search
                      </BreezeButton>
                    </div>
                    
                  </div>
                </form>
                <div class="border-b border-gray-200 shadow">
                  <table class="table-fixed">
                    <thead class="bg-gray-50">
                    <tr>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        ID
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Name
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Author Name
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Description
                      </th>
                      <th class="px-6 py-2 text-xs text-gray-500">
                        Created_at
                      </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <tr class="whitespace-nowrap" v-for="product in products">
                      <td class="px-6 py-4 text-sm text-gray-500">
                        {{ product.id }}
                      </td>
                      <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                          {{ product.name }}
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                          {{ product.author.name }}
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                          {{ product.description }}
                        </div>
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-500">
                        {{ filterDate(product.created_at) }}
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>

export default {
  props: {
    products: Array,
    name: String,
    createdAt: String,
    authorName: String,
  },
  data() {
    return {
      form: {
        name: '',
        author_name: '',
        created_at: '',
      },
    }
  },
  methods: {
    submit() {
      this.form.name = this.name;
      this.form.author_name = this.authorName;
      this.form.created_at = this.createdAt;
      this.$inertia.get('/products', this.form)
    },
    filterDate(date) {
      const d = new Date(date);
      return d.toLocaleString('en-US');
    }
  },
}
</script>