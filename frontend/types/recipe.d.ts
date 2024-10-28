export type Ingredient = {
  id: number;
  name: string;
  description: string;
};

export type Step = {
  id: number;
  name: string;
  description: string;
  order: number;
};

export type Recipe = {
  id: number;
  slug: string;
  name: string;
  description: string;
  email: string;
  ingredients: Ingredient[];
  steps: Step[];
};
