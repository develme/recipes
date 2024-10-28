export type ApiResponse<T, L extends Record<string, any> = {}> = {
  data: T;
  links: L;
};

export type ApiCollectionResponse<T, L extends Record<string, any> = {}> = {
  data: ApiResponse<T, L>[];
  links: L;
};
