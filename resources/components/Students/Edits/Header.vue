<template>
    <div class="row">
        <div class="col">
            <ul class="NavLinks">
                <li style="margin-left: 20px">
                    <router-link to="/student/dashboard">
                        <i class="fa-solid fa-house"></i>&nbsp;Dashboard
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="col"></div>
    </div>
</template>
<script>
export default {
    name: "Header",
};
</script>
