export type ApiResponse<
  T,
  L extends Record<string, unknown> = Record<string, unknown>,
> = {
  data: T;
  links: L;
};

export type ApiCollectionResponse<
  T,
  L extends Record<string, unknown> = Record<string, unknown>,
> = {
  data: ApiResponse<T, L>[];
  links: L;
};
