interface Pagination<Type> {
  current_page: number;
  data: Type[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: { url: string | null; label: string; active: Boolean }[];
  next_page_url: string;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}

interface User {
  id: string;
  name: string;
  email: string;
  created_at: string;
  updated_at: string;
}

interface Board {
  
}

interface Entry {
  id: string;
  title: string;
  content: string;
  user?: any;
  fields?: Entry[];
  board: Board;
  comments_count?: number;
  activities?: Activity[];
  created_at: string;
  updated_at: string;
}
interface Field {
  id: string;
  title: string;
  values: any[];
}

interface Activity {
  id: number | string;
  user_id: number;
  user: User;
  entry_id: string;
  event: string;
  old_values: object;
  new_values: object;
  meta_data?: any;
  created_at: string;
}
