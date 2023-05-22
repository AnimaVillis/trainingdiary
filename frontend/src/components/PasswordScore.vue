<template>
  <div class="relative select-none text-center w-full">
    <p 
      class="absolute mt-1 text-sm"
      :class="description.color"
    >
      {{ description.label }}
    </p>
  </div>   
</template>

<script>
import { zxcvbn, zxcvbnOptions } from "@zxcvbn-ts/core";
import zxcvbnCommonPackage from "@zxcvbn-ts/language-common";
import zxcvbnEnPackage from "@zxcvbn-ts/language-en";
import { defineComponent, computed, watch } from 'vue'

export default defineComponent({
  props: {
      value: {
      type: String,
      required: true,
    },
  },

  emits: ["passed", "failed"],

  setup(props, context) {
    const options = {
      dictionary: {
        ...zxcvbnCommonPackage.dictionary,
        ...zxcvbnEnPackage.dictionary,
      },

      graphs: zxcvbnCommonPackage.adjacencyGraphs,
      translations: zxcvbnEnPackage.translations,
    };

    zxcvbnOptions.setOptions(options);

    const score = computed(() => {
      const hasValue = props.value && props.value.length > 0;

      if (!hasValue) {
          return 0;
      }

      return zxcvbn(props.value).score + 1;
    });

    const descriptions = computed(() => [
      { color: "text-red-600",label: "Weak, my 2 years old son can break it!", },
      { color: "text-red-300", label: "Still weak, keep on trying!" },
      { color: "text-yellow-400", label: "We are getting there..." },
      { color: "text-green-200", label: "Nice, but you can still do better" },
      { color: "text-green-400", label: "Congratulations, you made it!", },
    ]);

    const description = computed(() =>
      props.value && props.value.length > 0
        ? descriptions.value[score.value - 1]
        : {
            color: "bg-transparent",
            label: "Start typing to check your password",
          }
    );

    const isPasswordStrong = computed(() => score.value >= 4);

    watch(isPasswordStrong, (value) => {
      value 
        ? context.emit("passed") 
        : context.emit("failed");
    });

    return { 
      description,
      score,
      isPasswordStrong
    }
        
  },
})
</script>
