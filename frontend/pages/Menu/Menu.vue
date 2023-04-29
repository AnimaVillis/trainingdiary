<template>
  <div class="mail-container">
    <div class="container">
      <div class="bg-slate-900 w-40 rounded-3xl">
        <ul class="uppercase text-center text-orange-400 m-2">
          <li class="li">
            Exercises
            <ul class="dropdown-container">
              <li class="dropdown">Link1</li>
              <li class="dropdown">Link2</li>
              <li class="dropdown">Link3</li>
              <li class="dropdown">Link4</li>
              <li class="dropdown">Link5</li>
            </ul>
          </li>
          <li class="li">
            Settings
            <ul class="dropdown-container">
              <li class="dropdown">Link1</li>
              <li class="dropdown">Link2</li>
              <li class="dropdown">Link3</li>
            </ul>
          </li>
          <li class="li">
            Coach
            <ul class="dropdown-container">
              <li class="dropdown">Link1</li>
              <li class="dropdown">Link2</li>
              <li class="dropdown">Link3</li>
              <li class="dropdown">Link4</li>
            </ul>
          </li>
          <li
            class="m-2 mx-0 rounded-full p-1 px-4 text-center hover:bg-slate-800 hover:text-orange-500 hover:transition-all hover:duration-300 hover:ease-in cursor-pointer"
          >
            About me
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
.mail-container {
  margin-top: 25px;
}
.li {
  margin: 8px 0;
  position: relative;
  border-radius: 100px;
  padding: 4px 16px;
  text-align: center;
  cursor: pointer;
  z-index: 5;
}
.li:hover {
  color: rgb(249, 115, 42);
  background-color: rgb(30, 41, 59);
  transition: all 0.3s ease-in;
}
.li::before,
.li::after {
  content: "";
  background-color: transparent;
  position: absolute;
  height: 2px;
  width: 12px;
  transition: all 0.3s ease-in;
}
.li:hover::before,
.li:hover::after {
  background-color: rgb(249, 115, 42);
  transition: all 0.3s ease-in;
}
.li::before {
  transform: rotate(45deg);
  top: 36%;
  left: 120px;
}
.li::after {
  transform: rotate(-45deg);
  bottom: 35%;
  left: 120px;
}
.dropdown-container {
  box-sizing: border-box;
  width: 120px;
  opacity: 0;
  visibility: hidden;
  top: 0px;
  left: 145px;
  text-transform: none;
  border-radius: 20px;
  padding: 4px 16px;
  position: absolute;
  background-color: rgb(15 23 42);
  transition: all 0.5s linear;
}
.li:hover > .dropdown-container {
  opacity: 1;
  visibility: visible;
  transition: all 0.5s linear;
}

.dropdown {
  border-radius: 20px;
  padding: 4px 16px;
}
.dropdown:hover {
  color: rgb(249, 115, 42);
  background-color: rgb(30, 41, 59);
  transition: all 0.3s ease-in;
}
</style>
