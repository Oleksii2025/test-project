<template>
    <center>
        <h1 class="font-bold">Page Not Found!</h1>
        <p>
            <router-link to="/dashboard" class="text-indigo-700">Go to dashboard?</router-link>
        </p>
    </center>
</template>

<style scoped>
center {
    margin: 15vw;
}

h1 {
    color: #718096;
    font-size: 3em;
    font-family: Arial, sans-serif;
    margin-bottom: 30px;
}

p {
    color: #4338CA;
    font-family: Arial, sans-serif;
    font-size: 2em;
}

p:hover {
    text-decoration: underline;
}
</style>
