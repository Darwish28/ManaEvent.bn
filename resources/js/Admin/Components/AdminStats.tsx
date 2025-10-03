import React from 'react'
import {
  ClipboardListIcon,
  CheckCircleIcon,
  CalendarIcon,
  UsersIcon,
} from 'lucide-react'
interface StatCardProps {
  title: string
  value: number
  icon: React.ReactNode
  color: string
}
const StatCard = ({ title, value, icon, color }: StatCardProps) => {
  return (
    <div className="bg-white rounded-lg shadow p-6 flex items-center">
      <div className={`rounded-full p-3 ${color}`}>{icon}</div>
      <div className="ml-4">
        <h3 className="text-gray-500 text-sm font-medium">{title}</h3>
        <p className="text-2xl font-semibold">{value}</p>
      </div>
    </div>
  )
}
interface AdminStatsProps {
  totalSubmissions: number
  pendingApprovals: number
  publishedEvents: number
  registeredUsers: number
}
const AdminStats = ({
  totalSubmissions,
  pendingApprovals,
  publishedEvents,
  registeredUsers,
}: AdminStatsProps) => {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <StatCard
        title="Total Submissions"
        value={totalSubmissions}
        icon={<ClipboardListIcon size={24} className="text-blue-500" />}
        color="bg-blue-100"
      />
      <StatCard
        title="Pending Approvals"
        value={pendingApprovals}
        icon={<CheckCircleIcon size={24} className="text-yellow-500" />}
        color="bg-yellow-100"
      />
      <StatCard
        title="Published Events"
        value={publishedEvents}
        icon={<CalendarIcon size={24} className="text-green-500" />}
        color="bg-green-100"
      />
      <StatCard
        title="Registered Users"
        value={registeredUsers}
        icon={<UsersIcon size={24} className="text-purple-500" />}
        color="bg-purple-100"
      />
    </div>
  )
}
export default AdminStats
