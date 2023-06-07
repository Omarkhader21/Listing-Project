<template>
  <div>
    Index
  </div>
  <Link rel="stylesheet" href="/Hello">Hello World</Link>
  <div>
    The message is : {{ message }}
  </div>
  <div>
    Name : {{ Name }} <br />

    Family Name : {{ FamilyName }}
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'

defineProps(['message', 'Name', 'FamilyName'])
</script>


