USE [master]
GO
/****** Object:  Database [mrbs]    Script Date: 12/27/2020 12:20:22 AM ******/
CREATE DATABASE [mrbs]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'mrbs', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\mrbs.mdf' , SIZE = 3136KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'mrbs_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\mrbs_log.ldf' , SIZE = 784KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [mrbs] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [mrbs].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [mrbs] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [mrbs] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [mrbs] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [mrbs] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [mrbs] SET ARITHABORT OFF 
GO
ALTER DATABASE [mrbs] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [mrbs] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [mrbs] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [mrbs] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [mrbs] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [mrbs] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [mrbs] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [mrbs] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [mrbs] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [mrbs] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [mrbs] SET  ENABLE_BROKER 
GO
ALTER DATABASE [mrbs] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [mrbs] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [mrbs] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [mrbs] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [mrbs] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [mrbs] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [mrbs] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [mrbs] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [mrbs] SET  MULTI_USER 
GO
ALTER DATABASE [mrbs] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [mrbs] SET DB_CHAINING OFF 
GO
ALTER DATABASE [mrbs] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [mrbs] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [mrbs]
GO
/****** Object:  Table [dbo].[categories]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[categories](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](199) NOT NULL,
	[user_id] [int] NOT NULL,
	[status] [bit] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[migrations]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[migrations](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[migration] [nvarchar](255) NOT NULL,
	[batch] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[password_resets]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[password_resets](
	[email] [nvarchar](255) NOT NULL,
	[token] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[posts]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[posts](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[purpose] [nvarchar](max) NOT NULL,
	[meetingdate] [date] NOT NULL,
	[starttime] [time](7) NOT NULL,
	[endtime] [time](7) NOT NULL,
	[meetingtype] [nvarchar](11) NOT NULL,
	[total] [int] NOT NULL,
	[postingdate] [date] NOT NULL,
	[postuser_id] [int] NOT NULL,
	[room_id] [int] NOT NULL,
	[category_id] [int] NOT NULL,
	[status] [nvarchar](12) NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[rooms]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[rooms](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](199) NOT NULL,
	[capacity] [int] NOT NULL,
	[user_id] [int] NOT NULL,
	[status] [bit] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[t_leaves_departments]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[t_leaves_departments](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[dep_name] [nvarchar](191) NOT NULL,
	[hod_id] [int] NULL,
	[dep_creator_id] [int] NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[t_leaves_designations]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[t_leaves_designations](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[designation_name] [nvarchar](191) NOT NULL,
	[des_creator_id] [int] NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[users]    Script Date: 12/27/2020 12:20:22 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[staffid] [nvarchar](191) NULL,
	[name] [nvarchar](191) NOT NULL,
	[role] [nvarchar](191) NULL,
	[email] [nvarchar](191) NULL,
	[password] [nvarchar](191) NOT NULL,
	[mobile] [nvarchar](11) NULL,
	[gender] [nvarchar](191) NULL,
	[designation_id] [int] NULL,
	[line_man_id] [int] NULL,
	[band_id] [int] NULL,
	[department_id] [int] NULL,
	[join_date] [datetime] NULL,
	[onProbation] [int] NULL,
	[active] [int] NULL,
	[email_verified_at] [datetime] NULL,
	[picture] [nvarchar](199) NULL,
	[remember_token] [nvarchar](100) NULL,
	[is_mancom] [int] NOT NULL,
	[status_updated_by] [int] NULL,
	[status_updated_at] [datetime] NULL,
	[ims_id] [nvarchar](191) NULL,
	[role_id] [int] NULL,
	[car_booking_role_id] [int] NOT NULL,
	[room_booking_role] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[categories] ON 

INSERT [dbo].[categories] ([id], [name], [user_id], [status], [created_at], [updated_at]) VALUES (1, N'Problem Solving Meetings', 1, 1, CAST(0x0000AC9D01782FDD AS DateTime), CAST(0x0000AC9D01782FDD AS DateTime))
SET IDENTITY_INSERT [dbo].[categories] OFF
SET IDENTITY_INSERT [dbo].[migrations] ON 

INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (43, N'2014_10_12_100000_create_password_resets_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (44, N'2020_12_25_233518_create_t_leave_users_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (45, N'2020_12_25_233626_create_rooms_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (46, N'2020_12_25_233639_create_categories_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (47, N'2020_12_25_233657_create_posts_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (48, N'2020_12_25_233721_create_t_leaves_designations_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (49, N'2020_12_25_233734_create_t_leaves_departments_table', 1)
SET IDENTITY_INSERT [dbo].[migrations] OFF
SET IDENTITY_INSERT [dbo].[posts] ON 

INSERT [dbo].[posts] ([id], [purpose], [meetingdate], [starttime], [endtime], [meetingtype], [total], [postingdate], [postuser_id], [room_id], [category_id], [status], [created_at], [updated_at]) VALUES (1, N'Meeting with BANK ASIA', CAST(0xF9410B00 AS Date), CAST(0x0700A8E76F4B0000 AS Time), CAST(0x0700DCC9A04F0000 AS Time), N'Internal', 10, CAST(0xF8410B00 AS Date), 1, 1, 1, N'booked', CAST(0x0000AC9D017D553D AS DateTime), CAST(0x0000AC9D017D553D AS DateTime))
INSERT [dbo].[posts] ([id], [purpose], [meetingdate], [starttime], [endtime], [meetingtype], [total], [postingdate], [postuser_id], [room_id], [category_id], [status], [created_at], [updated_at]) VALUES (14, N'Meeting with BANK ASIA', CAST(0xF9410B00 AS Date), CAST(0x070010ACD1530000 AS Time), CAST(0x07007870335C0000 AS Time), N'External', 2, CAST(0xF9410B00 AS Date), 1, 1, 1, N'booked', CAST(0x0000AC9E00022393 AS DateTime), CAST(0x0000AC9E00022393 AS DateTime))
SET IDENTITY_INSERT [dbo].[posts] OFF
SET IDENTITY_INSERT [dbo].[rooms] ON 

INSERT [dbo].[rooms] ([id], [name], [capacity], [user_id], [status], [created_at], [updated_at]) VALUES (1, N'Zomuna', 10, 1, 1, CAST(0x0000AC9D01781FDE AS DateTime), CAST(0x0000AC9D01781FDE AS DateTime))
SET IDENTITY_INSERT [dbo].[rooms] OFF
SET IDENTITY_INSERT [dbo].[t_leaves_departments] ON 

INSERT [dbo].[t_leaves_departments] ([id], [dep_name], [hod_id], [dep_creator_id], [created_at], [updated_at]) VALUES (1, N'IT', NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[t_leaves_departments] OFF
SET IDENTITY_INSERT [dbo].[t_leaves_designations] ON 

INSERT [dbo].[t_leaves_designations] ([id], [designation_name], [des_creator_id], [created_at], [updated_at]) VALUES (1, N'Officer', NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[t_leaves_designations] OFF
SET IDENTITY_INSERT [dbo].[users] ON 

INSERT [dbo].[users] ([id], [staffid], [name], [role], [email], [password], [mobile], [gender], [designation_id], [line_man_id], [band_id], [department_id], [join_date], [onProbation], [active], [email_verified_at], [picture], [remember_token], [is_mancom], [status_updated_by], [status_updated_at], [ims_id], [role_id], [car_booking_role_id], [room_booking_role], [created_at], [updated_at]) VALUES (1, NULL, N'Chandan', NULL, N'chandan@guardianlife.com.bd', N'$2y$10$c9leBw2gEqPqVjRy4vopJ.80UvOhsTe3cslzD8D8XMCYVZN2v5aLm', NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 4, N'admin', CAST(0x0000AC9D0004B94C AS DateTime), CAST(0x0000AC9D0004B94C AS DateTime))
SET IDENTITY_INSERT [dbo].[users] OFF
SET ANSI_PADDING ON

GO
/****** Object:  Index [password_resets_email_index]    Script Date: 12/27/2020 12:20:22 AM ******/
CREATE NONCLUSTERED INDEX [password_resets_email_index] ON [dbo].[password_resets]
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON

GO
/****** Object:  Index [rooms_name_unique]    Script Date: 12/27/2020 12:20:22 AM ******/
CREATE UNIQUE NONCLUSTERED INDEX [rooms_name_unique] ON [dbo].[rooms]
(
	[name] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT ('0') FOR [is_mancom]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT ('4') FOR [car_booking_role_id]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT ('user') FOR [room_booking_role]
GO
USE [master]
GO
ALTER DATABASE [mrbs] SET  READ_WRITE 
GO
