import { ref, reactive, toRefs, onMounted } from "vue";

export function useResource<T>(url: string, data: T & { id: number }) {
  const resource = ref<T>({...data});
  
  const state = reactive({
    loading: false,
    disabled: false,
  });

  onMounted(() => {
    Echo
      .private('entries.' + data.id)
      .listen('entries.updated', (e) => {
        resource.value = e.resource
      })
  })

  return {
    resource,
    ...toRefs(state)
  };
}
