import { ref, reactive, toRefs } from "vue";
import axios from "axios";
import { cloneDeep } from "lodash";

export function useResources<T>(url: string, data: Pagination<T>) {
  const resources = ref<Pagination<T>>(cloneDeep({ ...data }));
  const params = reactive({
    per_page: data.per_page ?? 10,
    page: data.current_page ?? 1,
  });
  const state = reactive({
    loading: false,
    disabled: false,
  });

  function loadMore() {
    if (state.disabled) return;
    params.page += 1;
    state.loading = true;
    axios.get(url, { params }).then((res) => {
      resources.value.data = resources.value.data.slice().concat(res.data.data);
      state.loading = false;
      console.log(resources.value.last_page, params.page);
      if (resources.value.last_page == params.page) {
        state.disabled = true;
      }
    });
  }

  return {
    data: resources,
    ...toRefs(state),
    loadMore,
  };
}
