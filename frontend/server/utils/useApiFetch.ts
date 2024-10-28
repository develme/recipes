import {
  type NitroFetchOptions,
  type NitroFetchRequest,
  type AvailableRouterMethod,
} from "nitropack";

export const useApiFetch = <T>(
  path: string,
  options?: NitroFetchOptions<
    NitroFetchRequest,
    AvailableRouterMethod<NitroFetchRequest>
  >,
  version = "v1",
) => {
  const { apiUrl } = useRuntimeConfig();

  return $fetch<T>(`${apiUrl}/api/${version}/${path}`, options);
};
