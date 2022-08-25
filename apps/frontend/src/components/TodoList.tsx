import type { TodoListsQuery } from 'graphql'
import { FC } from 'react'

type Props = {
  readonly todoLists: TodoListsQuery['todoLists']
}

const TodoList: FC<Props> = ({ todoLists }) => <pre>{JSON.stringify({ todoLists }, null, '\t')}</pre>

export default TodoList
