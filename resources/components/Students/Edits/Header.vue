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

<style scoped>
.btn{
    border-radius: 0
}
.TopBar1 {
    box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
}
.EditCard {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
}

.fa-solid {
    color: #fec107;
}
.NavLinks2 {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-end;
}
.NavLinks2 li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks2 li a {
    text-decoration: none;
    color: #151419;
}
.NavLinks {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-start;
}
.NavLinks li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks li a {
    text-decoration: none;
    color: #151419;
}
.LinkItem {
    font-size: 18px;
    color: #151419;
    padding: 2px 10px;
}

.userdropdown {
    position: relative;
    /* display: inline-block; */
}

.userdropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 220px;
    box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
    padding: 12px 16px;
    z-index: 1;
    right: -10px;
    /* top: 50px; */
}
.userdropdown-content a {
    color: #fec107;
    font-size: 18px;
}
.userdropdown-content a:hover {
    color: #fec107;
    /* font-size: 14px; */
}
.userdropdown:hover .userdropdown-content {
    display: block;
}

.UserName {
    color: #151419;
    text-transform: capitalize;
    font-weight: 600;
}
.UserName:hover {
    cursor: pointer;
}
.EditBtn {
    background-color: #029e02;
    color: white;
    font-weight: 600;
    outline: none;
    box-shadow: none;
}
.EditBtn:focus {
    outline: none;
    box-shadow: none;
}
.OutLineRemove:focus {
    outline: none;
    box-shadow: none;
}
.OutLineRemove {
    background-color: #fec107;
}
.OutLineRemove:hover {
    background-color: #ffcb2efb;
}
.EditBtn:hover {
    background-color: #03b103;
    color: white;
}
.InputBox:focus {
    outline: none;
    box-shadow: none;
}

.DeleteUser:hover{
    cursor: pointer;
}
</style>

